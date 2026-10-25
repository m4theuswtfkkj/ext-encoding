--TEST--
Test array batch serialization and deserialization
--SKIPIF--
<?php if(!extension_loaded("encoding")) die("skip: extension not loaded"); ?>
--FILE--
<?php

use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\Byte;
use pmmp\encoding\BE;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

// Test ByteBufferWriter initial capacity
$w = new ByteBufferWriter("", 1024);
var_dump($w->getReservedLength() >= 1024);

// Test LE signed int array
$ints = [0, 1, -1, 123456, -987654, 2147483647, -2147483648];
LE::writeSignedIntArray($w, $ints);
$bytes = $w->getData();

$r = new ByteBufferReader($bytes);
$readInts = LE::readSignedIntArray($r, count($ints));
var_dump($readInts === $ints);

// Test unpack / pack signed int array
$packed = LE::packSignedIntArray($ints);
var_dump($packed === $bytes);
$unpacked = LE::unpackSignedIntArray($packed, count($ints));
var_dump($unpacked === $ints);

// Test BE signed int array
$wBE = new ByteBufferWriter();
BE::writeSignedIntArray($wBE, $ints);
$bytesBE = $wBE->getData();
$rBE = new ByteBufferReader($bytesBE);
$readIntsBE = BE::readSignedIntArray($rBE, count($ints));
var_dump($readIntsBE === $ints);

// Test Byte array
$bytesArr = [0, 255, 128, 64, 1, 42];
$wByte = new ByteBufferWriter();
Byte::writeUnsignedArray($wByte, $bytesArr);
$rByte = new ByteBufferReader($wByte->getData());
$readBytes = Byte::readUnsignedArray($rByte, count($bytesArr));
var_dump($readBytes === $bytesArr);

// Test Float array
$floats = [0.0, 1.5, -2.25, 1000.125];
$wFloat = new ByteBufferWriter();
LE::writeFloatArray($wFloat, $floats);
$rFloat = new ByteBufferReader($wFloat->getData());
$readFloats = LE::readFloatArray($rFloat, count($floats));
var_dump($readFloats === $floats);

// Test VarInt array
$varints = [0, 1, 127, 128, 16384, 2097151, 268435455];
$wVarInt = new ByteBufferWriter();
VarInt::writeUnsignedIntArray($wVarInt, $varints);
$rVarInt = new ByteBufferReader($wVarInt->getData());
$readVarInts = VarInt::readUnsignedIntArray($rVarInt, count($varints));
var_dump($readVarInts === $varints);

// Test exception on reading past end of buffer
try {
    $rSmall = new ByteBufferReader("1234");
    LE::readSignedIntArray($rSmall, 10);
    echo "FAIL: expected exception\n";
} catch (\pmmp\encoding\DataDecodeException $e) {
    echo "OK: DataDecodeException caught\n";
}
?>
--EXPECT--
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
OK: DataDecodeException caught
