<?php
namespace {
    require_once __DIR__ .'/bootstrap.php';

    echo $notSetVariable;

    function someFunction() {
        $klass = new Test\Klass();
        $klass->test("test arg");
    }

    someFunction();

    $pdo = new PDO('unknown');

}

namespace Test {
    class Klass
    {
        public function test($arg)
        {
            $this->doTest($arg);
        }

        protected function doTest($arg)
        {
            throw new Exception('Test exception with '. $arg);
        }
    }

    class Exception extends \Exception
    {

    }
}
