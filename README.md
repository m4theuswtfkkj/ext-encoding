# ext-encoding
This extension provides high-performance raw data encoding & decoding utilities for PHP.

It was designed to supersede [`pocketmine/binaryutils`](https://github.com/pmmp/BinaryUtils) and the painfully slow PHP functions [`pack()`](https://www.php.net/manual/en/function.pack.php) and [`unpack()`](https://www.php.net/manual/en/function.unpack.php).

## Real-world performance tests
- [`pocketmine/nbt`](https://github.com/pmmp/NBT) was tested with release 0.2.1, and showed 1.5x read and 2x write performance with some basic synthetic tests.

## Performance
Batch array functions are ~50x faster than PHP loops for writing and ~9x for reading; VarInt batches are ~60-70x faster than `chr()`/`ord()` loops.
Full methodology, device specs and results: [docs/BENCHMARKS.md](docs/BENCHMARKS.md). To reproduce: `php -d extension=encoding.so benchmarks/bench.php` (and `benchmarks/verify.php` for a correctness check).

## API
A recent IDE stub can usually be found in our [custom stubs repository](https://github.com/pmmp/phpstorm-stubs/blob/fork/encoding/encoding.php). Stubs for this fork are also included in `stubs/`.

> [!NOTE]
> Although `ext-encoding` provides similar functionality to `pocketmine/binaryutils`, it is *not* a drop-in replacement.
> Its API is completely different and incompatible.

The API has been designed with the lessons learned from `pocketmine/binaryutils` in mind. Most notably:
- Readers and writers have fully separated APIs - no more accidentally writing while intending to read or vice versa
- Endian-reversible types are implemented in `LE::` and `BE::` static methods, which avoids accidentally using the wrong byte order
- All integer-accepting and returning functions explicitly state whether they work with `Signed` or `Unsigned` integers
- Batch array operations (`read*Array`, `unpack*Array`, `write*Array`, `pack*Array`) allow zero-copy operations on PHP arrays

### Usage Example
```php
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\LE;
use pmmp\encoding\BE;
use pmmp\encoding\Byte;
use pmmp\encoding\VarInt;

// ByteBufferWriter with optional pre-allocation
$writer = new ByteBufferWriter("", 1024);

// Scalar writes
LE::writeSignedInt($writer, 123456);
BE::writeUnsignedShort($writer, 65535);

// Native batch array writes (50x+ faster than PHP loops)
LE::writeSignedIntArray($writer, [1, 2, 3, 4, 5]);

// Direct pack / unpack without creating writer/reader objects
$packedBytes = LE::packSignedIntArray([10, 20, 30]);
$unpackedInts = LE::unpackSignedIntArray($packedBytes, 3);

// Reading from ByteBufferReader
$reader = new ByteBufferReader($writer->getData());
$intVal = LE::readSignedInt($reader);
$shortVal = BE::readUnsignedShort($reader);
$arrayVals = LE::readSignedIntArray($reader, 5);
```

## More
- [FAQ](docs/FAQ.md) - design rationale (why so many functions, why static methods, why explicit signedness)
