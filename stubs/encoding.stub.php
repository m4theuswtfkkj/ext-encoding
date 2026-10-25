<?php

/**
 * IDE Stub file for ext-encoding static helper classes.
 * Contains definitions for LE, BE, Byte, and VarInt with scalar and batch array functions.
 */

namespace pmmp\encoding;

final class LE {
    private function __construct() {}

    public static function readSignedShort(ByteBufferReader $reader) : int {}
    public static function unpackSignedShort(string $buffer) : int {}
    public static function writeSignedShort(ByteBufferWriter $writer, int $value) : void {}
    public static function packSignedShort(int $value) : string {}

    public static function readSignedShortArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackSignedShortArray(string $buffer, int $count) : array {}
    public static function writeSignedShortArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packSignedShortArray(array $values) : string {}

    public static function readUnsignedShort(ByteBufferReader $reader) : int {}
    public static function unpackUnsignedShort(string $buffer) : int {}
    public static function writeUnsignedShort(ByteBufferWriter $writer, int $value) : void {}
    public static function packUnsignedShort(int $value) : string {}

    public static function readUnsignedShortArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackUnsignedShortArray(string $buffer, int $count) : array {}
    public static function writeUnsignedShortArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packUnsignedShortArray(array $values) : string {}

    public static function readSignedInt(ByteBufferReader $reader) : int {}
    public static function unpackSignedInt(string $buffer) : int {}
    public static function writeSignedInt(ByteBufferWriter $writer, int $value) : void {}
    public static function packSignedInt(int $value) : string {}

    public static function readSignedIntArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackSignedIntArray(string $buffer, int $count) : array {}
    public static function writeSignedIntArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packSignedIntArray(array $values) : string {}

    public static function readUnsignedInt(ByteBufferReader $reader) : int {}
    public static function unpackUnsignedInt(string $buffer) : int {}
    public static function writeUnsignedInt(ByteBufferWriter $writer, int $value) : void {}
    public static function packUnsignedInt(int $value) : string {}

    public static function readUnsignedIntArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackUnsignedIntArray(string $buffer, int $count) : array {}
    public static function writeUnsignedIntArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packUnsignedIntArray(array $values) : string {}

    public static function readSignedLong(ByteBufferReader $reader) : int {}
    public static function unpackSignedLong(string $buffer) : int {}
    public static function writeSignedLong(ByteBufferWriter $writer, int $value) : void {}
    public static function packSignedLong(int $value) : string {}

    public static function readSignedLongArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackSignedLongArray(string $buffer, int $count) : array {}
    public static function writeSignedLongArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packSignedLongArray(array $values) : string {}

    public static function readUnsignedLong(ByteBufferReader $reader) : int {}
    public static function unpackUnsignedLong(string $buffer) : int {}
    public static function writeUnsignedLong(ByteBufferWriter $writer, int $value) : void {}
    public static function packUnsignedLong(int $value) : string {}

    public static function readUnsignedLongArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackUnsignedLongArray(string $buffer, int $count) : array {}
    public static function writeUnsignedLongArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packUnsignedLongArray(array $values) : string {}

    public static function readFloat(ByteBufferReader $reader) : float {}
    public static function unpackFloat(string $buffer) : float {}
    public static function writeFloat(ByteBufferWriter $writer, float $value) : void {}
    public static function packFloat(float $value) : string {}

    public static function readFloatArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackFloatArray(string $buffer, int $count) : array {}
    public static function writeFloatArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packFloatArray(array $values) : string {}

    public static function readDouble(ByteBufferReader $reader) : float {}
    public static function unpackDouble(string $buffer) : float {}
    public static function writeDouble(ByteBufferWriter $writer, float $value) : void {}
    public static function packDouble(float $value) : string {}

    public static function readDoubleArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackDoubleArray(string $buffer, int $count) : array {}
    public static function writeDoubleArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packDoubleArray(array $values) : string {}

    public static function readSignedTriad(ByteBufferReader $reader) : int {}
    public static function unpackSignedTriad(string $buffer) : int {}
    public static function writeSignedTriad(ByteBufferWriter $writer, int $value) : void {}
    public static function packSignedTriad(int $value) : string {}

    public static function readSignedTriadArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackSignedTriadArray(string $buffer, int $count) : array {}
    public static function writeSignedTriadArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packSignedTriadArray(array $values) : string {}

    public static function readUnsignedTriad(ByteBufferReader $reader) : int {}
    public static function unpackUnsignedTriad(string $buffer) : int {}
    public static function writeUnsignedTriad(ByteBufferWriter $writer, int $value) : void {}
    public static function packUnsignedTriad(int $value) : string {}

    public static function readUnsignedTriadArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackUnsignedTriadArray(string $buffer, int $count) : array {}
    public static function writeUnsignedTriadArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packUnsignedTriadArray(array $values) : string {}
}

final class BE {
    private function __construct() {}

    public static function readSignedShort(ByteBufferReader $reader) : int {}
    public static function unpackSignedShort(string $buffer) : int {}
    public static function writeSignedShort(ByteBufferWriter $writer, int $value) : void {}
    public static function packSignedShort(int $value) : string {}

    public static function readSignedShortArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackSignedShortArray(string $buffer, int $count) : array {}
    public static function writeSignedShortArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packSignedShortArray(array $values) : string {}

    public static function readUnsignedShort(ByteBufferReader $reader) : int {}
    public static function unpackUnsignedShort(string $buffer) : int {}
    public static function writeUnsignedShort(ByteBufferWriter $writer, int $value) : void {}
    public static function packUnsignedShort(int $value) : string {}

    public static function readUnsignedShortArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackUnsignedShortArray(string $buffer, int $count) : array {}
    public static function writeUnsignedShortArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packUnsignedShortArray(array $values) : string {}

    public static function readSignedInt(ByteBufferReader $reader) : int {}
    public static function unpackSignedInt(string $buffer) : int {}
    public static function writeSignedInt(ByteBufferWriter $writer, int $value) : void {}
    public static function packSignedInt(int $value) : string {}

    public static function readSignedIntArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackSignedIntArray(string $buffer, int $count) : array {}
    public static function writeSignedIntArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packSignedIntArray(array $values) : string {}

    public static function readUnsignedInt(ByteBufferReader $reader) : int {}
    public static function unpackUnsignedInt(string $buffer) : int {}
    public static function writeUnsignedInt(ByteBufferWriter $writer, int $value) : void {}
    public static function packUnsignedInt(int $value) : string {}

    public static function readUnsignedIntArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackUnsignedIntArray(string $buffer, int $count) : array {}
    public static function writeUnsignedIntArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packUnsignedIntArray(array $values) : string {}

    public static function readSignedLong(ByteBufferReader $reader) : int {}
    public static function unpackSignedLong(string $buffer) : int {}
    public static function writeSignedLong(ByteBufferWriter $writer, int $value) : void {}
    public static function packSignedLong(int $value) : string {}

    public static function readSignedLongArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackSignedLongArray(string $buffer, int $count) : array {}
    public static function writeSignedLongArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packSignedLongArray(array $values) : string {}

    public static function readUnsignedLong(ByteBufferReader $reader) : int {}
    public static function unpackUnsignedLong(string $buffer) : int {}
    public static function writeUnsignedLong(ByteBufferWriter $writer, int $value) : void {}
    public static function packUnsignedLong(int $value) : string {}

    public static function readUnsignedLongArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackUnsignedLongArray(string $buffer, int $count) : array {}
    public static function writeUnsignedLongArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packUnsignedLongArray(array $values) : string {}

    public static function readFloat(ByteBufferReader $reader) : float {}
    public static function unpackFloat(string $buffer) : float {}
    public static function writeFloat(ByteBufferWriter $writer, float $value) : void {}
    public static function packFloat(float $value) : string {}

    public static function readFloatArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackFloatArray(string $buffer, int $count) : array {}
    public static function writeFloatArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packFloatArray(array $values) : string {}

    public static function readDouble(ByteBufferReader $reader) : float {}
    public static function unpackDouble(string $buffer) : float {}
    public static function writeDouble(ByteBufferWriter $writer, float $value) : void {}
    public static function packDouble(float $value) : string {}

    public static function readDoubleArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackDoubleArray(string $buffer, int $count) : array {}
    public static function writeDoubleArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packDoubleArray(array $values) : string {}

    public static function readSignedTriad(ByteBufferReader $reader) : int {}
    public static function unpackSignedTriad(string $buffer) : int {}
    public static function writeSignedTriad(ByteBufferWriter $writer, int $value) : void {}
    public static function packSignedTriad(int $value) : string {}

    public static function readSignedTriadArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackSignedTriadArray(string $buffer, int $count) : array {}
    public static function writeSignedTriadArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packSignedTriadArray(array $values) : string {}

    public static function readUnsignedTriad(ByteBufferReader $reader) : int {}
    public static function unpackUnsignedTriad(string $buffer) : int {}
    public static function writeUnsignedTriad(ByteBufferWriter $writer, int $value) : void {}
    public static function packUnsignedTriad(int $value) : string {}

    public static function readUnsignedTriadArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackUnsignedTriadArray(string $buffer, int $count) : array {}
    public static function writeUnsignedTriadArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packUnsignedTriadArray(array $values) : string {}
}

final class Byte {
    private function __construct() {}

    public static function readSigned(ByteBufferReader $reader) : int {}
    public static function unpackSigned(string $buffer) : int {}
    public static function writeSigned(ByteBufferWriter $writer, int $value) : void {}
    public static function packSigned(int $value) : string {}

    public static function readSignedArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackSignedArray(string $buffer, int $count) : array {}
    public static function writeSignedArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packSignedArray(array $values) : string {}

    public static function readUnsigned(ByteBufferReader $reader) : int {}
    public static function unpackUnsigned(string $buffer) : int {}
    public static function writeUnsigned(ByteBufferWriter $writer, int $value) : void {}
    public static function packUnsigned(int $value) : string {}

    public static function readUnsignedArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackUnsignedArray(string $buffer, int $count) : array {}
    public static function writeUnsignedArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packUnsignedArray(array $values) : string {}
}

final class VarInt {
    private function __construct() {}

    public static function readSignedInt(ByteBufferReader $reader) : int {}
    public static function unpackSignedInt(string $buffer) : int {}
    public static function writeSignedInt(ByteBufferWriter $writer, int $value) : void {}
    public static function packSignedInt(int $value) : string {}

    public static function readSignedIntArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackSignedIntArray(string $buffer, int $count) : array {}
    public static function writeSignedIntArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packSignedIntArray(array $values) : string {}

    public static function readUnsignedInt(ByteBufferReader $reader) : int {}
    public static function unpackUnsignedInt(string $buffer) : int {}
    public static function writeUnsignedInt(ByteBufferWriter $writer, int $value) : void {}
    public static function packUnsignedInt(int $value) : string {}

    public static function readUnsignedIntArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackUnsignedIntArray(string $buffer, int $count) : array {}
    public static function writeUnsignedIntArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packUnsignedIntArray(array $values) : string {}

    public static function readSignedLong(ByteBufferReader $reader) : int {}
    public static function unpackSignedLong(string $buffer) : int {}
    public static function writeSignedLong(ByteBufferWriter $writer, int $value) : void {}
    public static function packSignedLong(int $value) : string {}

    public static function readSignedLongArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackSignedLongArray(string $buffer, int $count) : array {}
    public static function writeSignedLongArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packSignedLongArray(array $values) : string {}

    public static function readUnsignedLong(ByteBufferReader $reader) : int {}
    public static function unpackUnsignedLong(string $buffer) : int {}
    public static function writeUnsignedLong(ByteBufferWriter $writer, int $value) : void {}
    public static function packUnsignedLong(int $value) : string {}

    public static function readUnsignedLongArray(ByteBufferReader $reader, int $count) : array {}
    public static function unpackUnsignedLongArray(string $buffer, int $count) : array {}
    public static function writeUnsignedLongArray(ByteBufferWriter $writer, array $values) : void {}
    public static function packUnsignedLongArray(array $values) : string {}
}
