<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class SearchCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    //Проверка наличия строки и кнопки поиска на странице
    public function checkSearchSelectors(AcceptanceTester $I): void
    {
        $I->amOnPage('/actions/Catalog.action');
        $I->seeElement('//*[@id="SearchContent"]/form/input[1]');
        $I->seeElement('//*[@id="SearchContent"]/form/input[2]');
    }
    //Проверка ввода в строке поиска
    public function checkSearchInput(AcceptanceTester $I): void
    {
        $I->amOnPage('/actions/Catalog.action');
        $I->fillField('//*[@id="SearchContent"]/form/input[1]', 'fish');
        $I->canSeeInField('//*[@id="SearchContent"]/form/input[1]', 'fish');
    }
    //Проверка результатов поиска с пустым запросом
    public function checkEmptySearch(AcceptanceTester $I): void
    {
        $I->amOnPage('/actions/Catalog.action');
        $I->fillField('//*[@id="SearchContent"]/form/input[1]', '');
        $I->click('//*[@id="SearchContent"]/form/input[2]');
        $I->see('Please enter a keyword to search for, then press the search button.');
    }
    //Проверка результатов поиска по слову "fish"
    public function checkFishSearch(AcceptanceTester $I): void
    {
        $I->amOnPage('/actions/Catalog.action');
        $I->fillField('//*[@id="SearchContent"]/form/input[1]', 'fish');
        $I->click('//*[@id="SearchContent"]/form/input[2]');
        $I->see('Fresh Water fish from China');
    }
    //Проверка результатов поиска по запросу со спец символом
    public function checkSpecCharSearch(AcceptanceTester $I): void
    {
        $I->amOnPage('/actions/Catalog.action');
        $I->fillField('//*[@id="SearchContent"]/form/input[1]', 'fi$h');
        $I->click('//*[@id="SearchContent"]/form/input[2]');
        $I->see('');
    }
    //Проверка результатов поиска по запросу из двух слов
    public function checkMultipleWordsSearch(AcceptanceTester $I): void
    {
        $I->amOnPage('/actions/Catalog.action');
        $I->fillField('//*[@id="SearchContent"]/form/input[1]', 'bulldog parrot');
        $I->click('//*[@id="SearchContent"]/form/input[2]');
        $I->see('Friendly dog from England');
        $I->see('Great companion for up to 75 years');
    }
    /*
    //Проверка результатов поиска по запросу с пробелами в начале и в конце
    public function checkSearchTermWithSpaces(AcceptanceTester $I): void
    {
        $I->amOnPage('/actions/Catalog.action');
        $I->fillField('//*[@id="SearchContent"]/form/input[1]', 'bulldog parrot');
    }
    */
    //Проверка результатов поиска по запросу с ошибкой
    public function checkMisspellSearch(AcceptanceTester $I): void
    {
        $I->amOnPage('/actions/Catalog.action');
        $I->fillField('//*[@id="SearchContent"]/form/input[1]', 'budog');
        $I->click('//*[@id="SearchContent"]/form/input[2]');
        $I->
    }
}
