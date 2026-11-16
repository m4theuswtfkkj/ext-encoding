<?php
use pmmp\encoding\{LE, BE, Byte, VarInt, ByteBufferReader, DataDecodeException};

$fail = 0;
function check(string $n, bool $c) { global $fail; if (!$c) { $fail++; echo "FAIL $n\n"; } }

$ints = array_merge(range(-500, 500), [PHP_INT_MAX >> 33, -(PHP_INT_MAX >> 33), 2147483647, -2147483648]);
check('LE int', LE::unpackSignedIntArray(pack('V*', ...$ints), count($ints)) === $ints);
check('BE int', BE::unpackSignedIntArray(pack('N*', ...$ints), count($ints)) === $ints);
check('LE uint', LE::unpackUnsignedIntArray(pack('V*', ...range(0, 5000, 7)), count(range(0, 5000, 7))) === range(0, 5000, 7));
$l = [PHP_INT_MAX, PHP_INT_MIN, 0, -1];
check('LE long', LE::unpackSignedLongArray(pack('P*', ...$l), 4) === $l);
$d = [1.5, -2.25, 0.0, 1e300];
check('BE double', BE::unpackDoubleArray(pack('E*', ...$d), 4) === $d);
check('LE float', LE::unpackFloatArray(pack('g*', 1.5, -2.5), 2) === [1.5, -2.5]);
$b = range(0, 255);
check('byte u', Byte::unpackUnsignedArray(implode('', array_map('chr', $b)), 256) === $b);
check('byte s', Byte::unpackSignedArray("\xff\x01", 2) === [-1, 1]);
$t = [-8388608, 8388607, 0, -1, 12345];
check('triad LE', LE::unpackSignedTriadArray(LE::packSignedTriadArray($t), 5) === $t);
check('triad BE', BE::unpackSignedTriadArray(BE::packSignedTriadArray($t), 5) === $t);
$vi = [0, 1, 127, 128, 300, 2147483647, -1, -2147483648];
check('varint s', VarInt::unpackSignedIntArray(VarInt::packSignedIntArray($vi), count($vi)) === $vi);
$vu = [0, 1, 127, 128, 300, 4294967295];
check('varint u', VarInt::unpackUnsignedIntArray(VarInt::packUnsignedIntArray($vu), count($vu)) === $vu);
$vl = [PHP_INT_MAX, PHP_INT_MIN, 0, -1, 1 << 40];
check('varlong s', VarInt::unpackSignedLongArray(VarInt::packSignedLongArray($vl), 5) === $vl);
check('empty', LE::unpackSignedIntArray('', 0) === [] && VarInt::unpackUnsignedIntArray('', 0) === []);

// errors / hostile counts
foreach ([
	fn() => LE::unpackSignedIntArray("abcd", 2),
	fn() => LE::unpackSignedIntArray("abcd", PHP_INT_MAX),
	fn() => LE::unpackSignedTriadArray("abcd", PHP_INT_MAX),
	fn() => Byte::unpackUnsignedArray("abcd", PHP_INT_MAX),
	fn() => VarInt::unpackUnsignedIntArray("\x01\x02", PHP_INT_MAX),
	fn() => VarInt::unpackSignedLongArray("\x01\x02", 1 << 40),
] as $i => $f) {
	try { $f(); check("hostile $i", false); } catch (DataDecodeException $e) {}
}
$r = new ByteBufferReader(LE::packSignedIntArray([1, 2, 3]) . "x");
LE::readSignedIntArray($r, 3);
check('offset', $r->getOffset() === 12);
echo $fail === 0 ? "ALL OK\n" : "$fail failures\n";
