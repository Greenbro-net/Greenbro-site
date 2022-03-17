<?php



use App\Model\AllProductsModel;
use App\Core\Configuration;


class SampleTest extends \PHPUnit\Framework\TestCase
{
    public function testTrueAssertsToTrue()
    {
        $this->assertTrue(true);         
    }

    public function testFalseAssertsToFalse()
    {
        $this->assertFalse(false);
    }

    public function testMockProductsAreReturned()
    {
        // $mockRepo = $this->createMock(\App\Model\AllProductsModel::class);

        // $products = $mockRepo->fetchProducts();
        
        // should return an array 
        // var_dump(Configuration::get_host());
        $allProductsModel = new AllProductsModel();

        $allProductsArray = $allProductsModel->getAllProducts();
        $this->assertIsArray($allProductsArray);
        // var_dump($allProductsModel);
    }

}