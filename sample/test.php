<?php
function regular_function() {}

abstract class ParentTest
{
    public function public_parent_method() {}
    protected function protected_parent_method() {}
    public static function static_method() {}
    protected static function protected_static_method() {}
}

class CallableTest extends ParentTest implements Countable
{
    public function __invoke() { } // Introduced in 5.3, see http://php.net/manual/language.oop5.magic.php
    protected function protected_method() { }
    public function is_callable($args)
    {
        return is_callable($args);
    }
    // Countable
    public function count()
    {
        return 1;
    }
}

$o = new CallableTest();

// Regular function:
var_dump(is_callable('regular_function')); // true

// Magic __invoke method:
var_dump(is_callable($o)); // true if PHP >= 5.3, false otherwise

// Countable implementation (regular method really):
var_dump(is_callable(array($o, 'count'))); // true

// Protected method from outside the object's scope:
var_dump(is_callable(array($o, 'protected_method'))); // false

// Protected method from inside the object's scope via public proxy method:
var_dump($o->is_callable(array($o, 'protected_method'))); // true

// Parent's public method
var_dump(is_callable(array($o, 'public_parent_method'))); // true

// Parent's protected method
var_dump(is_callable(array($o, 'protected_parent_method'))); // false

// Parent's protected method via proxy
var_dump($o->is_callable(array($o, 'protected_parent_method'))); // true

// Parent's static public method
var_dump(is_callable('CallableTest::static_method')); // true

// Parent's static protected method
var_dump(is_callable('CallableTest::protected_static_method')); // false

// Parent's static protected method via proxy
var_dump($o->is_callable('CallableTest::protected_static_method')); // true
?>