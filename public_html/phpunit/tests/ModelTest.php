<?php



use App\Model\AllProductsModel;
use App\Model\BookModel;
use App\Model\ClothesModel;
use App\Model\FoodModel;
use App\Model\GoodsModel;

// use App\Core\Configuration;

// ModelTest works only in singular form
class ModelTest extends \PHPUnit\Framework\TestCase
{
    // the test below for AllProductsModel testing
    public function testMockAllProductsModel()
    {
        $AllProductsModelObject = new AllProductsModel();
        $AllProductsModelArray = $AllProductsModelObject->getAllProducts();
        $this->assertIsArray($AllProductsModelArray);
    }

    // the test below for BookModel testing
    public function testMockBookModel()
    {
        $BookModelObject = new BookModel();
        $BookModelArray = $BookModelObject->getBooks();
        $this->assertIsArray($BookModelArray);
    }

    // the test below for ClothesModel testing
    public function testMockClothesModel()
    {
        $ClothesModelObject = new ClothesModel();
        $ClothesModelArray = $ClothesModelObject->getClothes();
        $this->assertIsArray($ClothesModelArray);
    }

    // the test below for FoodModel testing
    public function testMockFoodModel()
    {
        $FoodModelObject = new FoodModel();
        $FoodModelArray = $FoodModelObject->getFood();
        $this->assertIsArray($FoodModelArray);
    }

    // the test below for GoodsModel testing
    public function testMockGoodsModel()
    {
        $GoodsModelObject = new GoodsModel();
        $GoodsModelArray = $GoodsModelObject->getGoods();
        $this->assertIsArray($GoodsModelArray);
    }

    public function testTrueAssertsToTrue()
    {
        $this->assertTrue(true);         
    }

    public function testFalseAssertsToFalse()
    {
        $this->assertFalse(false);
    }

}