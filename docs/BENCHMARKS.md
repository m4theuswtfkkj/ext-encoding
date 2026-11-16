# ext-encoding benchmarks

All numbers were measured on-device (Termux), best of 3 runs.

## Environment
- **Device:** Samsung Galaxy A05 (`SM-A055M`), MediaTek Helio G85 (2x Cortex-A75 + 6x Cortex-A55), 4 GB RAM
- **Architecture:** ARMv8.2-A / aarch64 (fp, asimd, aes, pmull, crc32, atomics, asimddp)
- **OS:** Android 15, Termux
- **PHP:** 8.5.12 CLI (NTS for the `ext-encoding` run below; the older tables were taken on a ZTS build with `pmmpthread` 6.4.0)

## Results

Reproduce with:
```sh
php -d extension=/path/to/encoding.so benchmarks/verify.php   # correctness check first
php -d extension=/path/to/encoding.so benchmarks/bench.php 1000
```
1,000 iterations × 1,000 elements per operation (`-O2`).

### Array reads (optimized)
`read*Array`/`unpack*Array` now fill a packed `HashTable` directly (`ZEND_HASH_FILL_PACKED`) instead of calling `add_next_index_long()` per element, and never preallocate more than the input can hold.

| Operation | Before | After | Change |
|:--|--:|--:|:--|
| `LE::readSignedIntArray` | 55.24 ms | 5.95 ms | **9.3x** |
| `LE::unpackSignedIntArray` | 56.54 ms | 6.50 ms | **8.7x** |
| `BE::unpackSignedIntArray` | 58.24 ms | 8.61 ms | 6.8x |
| `Byte::unpackUnsignedArray` | 58.20 ms | 7.87 ms | 7.4x |
| `LE::unpackSignedTriadArray` | 59.81 ms | 16.11 ms | 3.7x |
| `LE::unpackDoubleArray` | 56.66 ms | 6.13 ms | 9.2x |
| `VarInt::unpackUnsignedIntArray` (small values) | 62.80 ms | 15.57 ms | 4.0x |
| `VarInt::unpackSignedIntArray` (large values) | 71.29 ms | 20.23 ms | 3.5x |

### Versus pure PHP

| Operation | PHP | ext-encoding | Speedup |
|:--|--:|--:|--:|
| Write 1,000 ints (loop vs `writeSignedIntArray`) | 213–281 ms | 4.2–4.9 ms | ~50x |
| Pack ints (`pack('V*')` vs `LE::packSignedIntArray`) | 57.5 ms | 4.1 ms | 14x |
| Unpack ints (`unpack('V*')` vs `LE::unpackSignedIntArray`) | 63.3 ms | 6.5 ms | 9.7x |
| VarInt encode (`chr()` loop vs `VarInt::packUnsignedIntArray`) | 995 ms | 15.5 ms | 64x |
| VarInt decode (`ord()` loop vs `VarInt::unpackUnsignedIntArray`) | 1,077 ms | 15.6 ms | 69x |
| Scalar pack ×1000 (`pack('V')` vs `LE::packSignedInt`) | 418 ms | 232 ms | 1.8x |

> [!NOTE]
> Scalar calls are dominated by PHP function-call overhead (~0.2 µs/call), so batch `*Array` APIs are where the big wins are.

### Earlier measurements (10,000 iterations, before the read optimization)

| Operation | Implementation | Time | Speedup |
|:--|:--|--:|:--|
| Write 1,000 ints | PHP loop (`LE::writeSignedInt`) | 3,243.63 ms | Baseline |
| Write 1,000 ints | `LE::writeSignedIntArray` | 61.28 ms | 52.93x |
| Pack 1,000 ints | `LE::packSignedIntArray` | 54.26 ms | 59.78x |
| Read 1,000 ints | PHP loop (`LE::readSignedInt`) | 2,175.05 ms | Baseline |
| Read 1,000 ints | `LE::readSignedIntArray` | 289.37 ms | 7.52x |
| Unpack 1,000 ints | `LE::unpackSignedIntArray` | 291.12 ms | 7.47x |

## Remaining optimization candidates
- `pack*Array` builds into a scratch buffer then copies into the return string (`RETVAL_STRINGL`); sizing exactly for fixed-width types would allow writing straight into a `zend_string`.
- Varint write/read use a byte-at-a-time loop; a fast path for values < 128 would help typical small-value packets.
- `readFixedSizeTypeArray`/`writeFixedSizeTypeArray` (`std::vector` variants in `Serializers.h`) appear unused by the PHP API and mutate their input when byte-swapping.
