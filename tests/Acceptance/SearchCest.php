<?php


namespace Acceptance;

use Tests\Support\AcceptanceTester;

class SearchCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->amOnPage('/actions/Catalog.action');
    }

    // tests
    //Проверка наличия строки и кнопки поиска на странице
    public function checkSearchSelectors(AcceptanceTester $I): void
    {
        $I->seeElement('//*[@id="SearchContent"]/form/input[1]');
        $I->seeElement('//*[@id="SearchContent"]/form/input[2]');
    }
    //Проверка ввода в строке поиска
    public function checkSearchInput(AcceptanceTester $I): void
    {
        $I->fillField('//*[@id="SearchContent"]/form/input[1]', 'fish');
        $I->seeInField('//*[@id="SearchContent"]/form/input[1]', 'fish');
    }

    //Проверка результатов поиска по слову "fish"
    public function checkFishSearch(AcceptanceTester $I): void
    {
        $I->fillField('//*[@id="SearchContent"]/form/input[1]', 'fish');
        $I->click('//*[@id="SearchContent"]/form/input[2]');
        $I->seeElement('//*[@id="Catalog"]/table');
        $I->see('Goldfish');
        $I->see('Angelfish');
    }

    //Проверка результатов поиска по запросу "dog"
    public function checkEmptyResult(AcceptanceTester $I): void
    {
        $I->fillField('//*[@id="SearchContent"]/form/input[1]', 'cat');
        $I->click('//*[@id="SearchContent"]/form/input[2]');
        $I->seeElement('//*[@id="Catalog"]/table');
        $I->see('');
    }

    //Проверка результатов поиска с пустым запросом
    public function checkEmptySearch(AcceptanceTester $I): void
    {
        $I->fillField('//*[@id="SearchContent"]/form/input[1]', '');
        $I->click('//*[@id="SearchContent"]/form/input[2]');
        $I->see('Please enter a keyword to search for, then press the search button.');
    }

    //Проверка результатов поиска по кривому запросу
    public function checkIncorrectSearch(AcceptanceTester $I): void
    {
        $I->fillField('//*[@id="SearchContent"]/form/input[1]', 'rsg!$$%dh2564');
        $I->click('//*[@id="SearchContent"]/form/input[2]');
        $I->seeElement('//*[@id="Catalog"]/table');
        $I->see('');
    }

    //Проверка результатов поиска по запросу со спец символом
    public function checkSpecCharSearch(AcceptanceTester $I): void
    {
        $I->fillField('//*[@id="SearchContent"]/form/input[1]', '\\\'');
        $I->click('//*[@id="SearchContent"]/form/input[2]');
        $I->see('');
    }

    //Проверка результатов поиска по запросу из двух слов
    public function checkMultipleWordsSearch(AcceptanceTester $I): void
    {
        $I->fillField('//*[@id="SearchContent"]/form/input[1]', 'bulldog parrot');
        $I->click('//*[@id="SearchContent"]/form/input[2]');
        $I->see('Bulldog');
        $I->see('Parrot');
    }

    //Проверка результатов поиска по запросу с пробелами в начале и в конце
    public function checkSearchTermWithSpaces(AcceptanceTester $I): void
    {
        $I->fillField('//*[@id="SearchContent"]/form/input[1]', '   bulldog   ');
        $I->click('//*[@id="SearchContent"]/form/input[2]');
        $I->see("Bulldog");
    }

    //Проверка результатов поиска по запросу с орфографической ошибкой
    public function checkMisspellSearch(AcceptanceTester $I): void
    {
        $I->fillField('//*[@id="SearchContent"]/form/input[1]', 'budog');
        $I->click('//*[@id="SearchContent"]/form/input[2]');
        $I->dontSee('bulldog');
    }

    //Проверка результатов поиска по запросу с id продукта (поле Product ID)
    public function checkProductIDSearch(AcceptanceTester $I): void
    {
        $I->fillField('//*[@id="SearchContent"]/form/input[1]', 'FI-FW-02');
        $I->click('//*[@id="SearchContent"]/form/input[2]');
        $I->see('FI-FW-02');
    }

    //Проверка результатов поиска по запросу с именем продукта (поле Name)
    public function checkNameSearch(AcceptanceTester $I): void
    {
        $I->fillField('//*[@id="SearchContent"]/form/input[1]', 'Goldfish');
        $I->click('//*[@id="SearchContent"]/form/input[2]');
        $I->see('Goldfish');
    }

}
