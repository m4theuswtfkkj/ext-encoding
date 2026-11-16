<?php
declare(strict_types=1);

/**
 * Micro-benchmarks for ext-encoding.
 *
 * Usage: php -d extension=/path/to/encoding.so benchmarks/bench.php [iterations]
 */

use pmmp\encoding\BE;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

$iterations = (int) ($argv[1] ?? 2000);
$elements = 1000;

function bench(string $name, int $iterations, Closure $fn) : void {
	$fn(); // warm-up
	$best = INF;
	for ($run = 0; $run < 3; $run++) {
		$start = hrtime(true);
		for ($i = 0; $i < $iterations; $i++) {
			$fn();
		}
		$best = min($best, (hrtime(true) - $start) / 1e6);
	}
	printf("%-44s %10.2f ms\n", $name, $best);
}

$ints = range(-500, 499);
$uints = range(0, 999);
$bigInts = array_map(fn(int $i) => $i * 100003, $uints);
$bytes = array_map(fn(int $i) => $i & 0xff, $uints);
$doubles = array_map(fn(int $i) => $i * 1.5, $uints);

$packedLE = LE::packSignedIntArray($ints);
$packedBE = BE::packSignedIntArray($ints);
$packedByte = Byte::packUnsignedArray($bytes);
$packedTriad = LE::packSignedTriadArray($ints);
$packedVarInt = VarInt::packUnsignedIntArray($uints);
$packedVarIntSigned = VarInt::packSignedIntArray($bigInts);
$packedDouble = LE::packDoubleArray($doubles);

echo "iterations: $iterations, elements/op: $elements, PHP " . PHP_VERSION . "\n\n";

echo "== Write ==\n";
bench('write LE int  (loop)', $iterations, function() use ($ints) {
	$w = new ByteBufferWriter();
	foreach ($ints as $v) { LE::writeSignedInt($w, $v); }
});
bench('write LE int  (array)', $iterations, function() use ($ints) {
	$w = new ByteBufferWriter();
	LE::writeSignedIntArray($w, $ints);
});
bench('pack  LE int  (array)', $iterations, fn() => LE::packSignedIntArray($ints));
bench('pack  BE int  (array)', $iterations, fn() => BE::packSignedIntArray($ints));
bench('pack  byte    (array)', $iterations, fn() => Byte::packUnsignedArray($bytes));
bench('pack  LE triad(array)', $iterations, fn() => LE::packSignedTriadArray($ints));
bench('pack  LE double(array)', $iterations, fn() => LE::packDoubleArray($doubles));
bench('pack  varint  (array, small)', $iterations, fn() => VarInt::packUnsignedIntArray($uints));
bench('pack  varint  (array, signed big)', $iterations, fn() => VarInt::packSignedIntArray($bigInts));
bench('PHP pack("V*")', $iterations, fn() => pack('V*', ...$ints));
bench('PHP chr() loop (varint)', $iterations, function() use ($uints) {
	$out = '';
	foreach ($uints as $v) {
		while ($v > 0x7f) { $out .= chr(($v & 0x7f) | 0x80); $v >>= 7; }
		$out .= chr($v);
	}
});

echo "\n== Read ==\n";
bench('read LE int   (loop)', $iterations, function() use ($packedLE, $elements) {
	$r = new ByteBufferReader($packedLE);
	for ($i = 0; $i < $elements; $i++) { LE::readSignedInt($r); }
});
bench('read LE int   (array)', $iterations, function() use ($packedLE, $elements) {
	LE::readSignedIntArray(new ByteBufferReader($packedLE), $elements);
});
bench('unpack LE int (array)', $iterations, fn() => LE::unpackSignedIntArray($packedLE, $elements));
bench('unpack BE int (array)', $iterations, fn() => BE::unpackSignedIntArray($packedBE, $elements));
bench('unpack byte   (array)', $iterations, fn() => Byte::unpackUnsignedArray($packedByte, $elements));
bench('unpack LE triad(array)', $iterations, fn() => LE::unpackSignedTriadArray($packedTriad, $elements));
bench('unpack LE double(array)', $iterations, fn() => LE::unpackDoubleArray($packedDouble, $elements));
bench('unpack varint (array, small)', $iterations, fn() => VarInt::unpackUnsignedIntArray($packedVarInt, $elements));
bench('unpack varint (array, signed big)', $iterations, fn() => VarInt::unpackSignedIntArray($packedVarIntSigned, $elements));
bench('PHP unpack("V*")', $iterations, fn() => unpack('V*', $packedLE));
bench('PHP ord() loop (varint)', $iterations, function() use ($packedVarInt, $elements) {
	$len = strlen($packedVarInt);
	$pos = 0;
	$out = [];
	while ($pos < $len) {
		$result = 0; $shift = 0;
		do {
			$b = ord($packedVarInt[$pos++]);
			$result |= ($b & 0x7f) << $shift;
			$shift += 7;
		} while ($b & 0x80);
		$out[] = $result;
	}
});

echo "\n== Scalar ==\n";
bench('VarInt::packUnsignedInt x1000', $iterations, function() use ($uints) {
	foreach ($uints as $v) { VarInt::packUnsignedInt($v); }
});
bench('LE::packSignedInt x1000', $iterations, function() use ($ints) {
	foreach ($ints as $v) { LE::packSignedInt($v); }
});
bench('PHP pack("V") x1000', $iterations, function() use ($ints) {
	foreach ($ints as $v) { pack('V', $v); }
});
