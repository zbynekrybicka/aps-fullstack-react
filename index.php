<?php
use App\Aps;
use App\Code\Component;

require_once __DIR__ . '/vendor/autoload.php';

$aps = new Aps();

$fullStack = $aps->fullStack();
$fullStack
    ->config('apiUrl', 'http://localhost:8080')
    ->state('authToken', null)
    ->state('preloader', false)
    ->state('lang', [])
    ->state('activeLang', 0)
    ->state('section', 0);

$fullStack
    ->lang('loginForm.roles.0', ['Obchodník', 'Salesman'])
    ->lang('loginForm.roles.1', ['Manažer', 'Manager'])
    ->lang('loginForm.roles.2', ['Administrátor', 'Admin']);

$app = $fullStack->component('App')
    ->style('width', '100%')
    ->style('background-color', '#FFF')
    ->style('margin-left', 'auto', Component::TABLET)
    ->style('margin-right', 'auto', Component::TABLET)
    ->style('width', '640px', Component::TABLET)
    ->style('width', '1024px', Component::PC);

$langs = $app->component('Langs')
    ->style('padding', '15px')
    ->style('text-align', 'right');
$langs->button('CzLang', 'langs.cz', ['Czech', 'Česky',], 'grey')
    ->clickReducer('switchLangCz', [ 'state.activeLang = 0']);
$langs->button('EnLang', 'langs.en', ['English', 'Anglicky'], 'grey')
    ->clickReducer('switchLangEn', [ 'state.activeLang = 1']);

/**
 *
 *
 * LoginForm
 */
$loginForm = $app->component('LoginForm')
    ->style('padding', '15px')
    ->attribute('if', '!state.authToken');

$loginForm->component('h1')
    ->attribute('lang', ['text', 'loginForm.header', ['Přihlašovací formulář', 'Login form']]);

$loginForm
    ->input('Username', 'text', 'loginForm.username', ['Přihlašovací jméno', 'Username'], 'postLogin')
    ->input('Password', 'password', 'loginForm.password', ['Heslo', 'Password'], 'postLogin')
    ->button('Login', 'loginForm.login', ['Přihlásit', 'Sign in'], 'blue')
    ->ajaxClick('postLogin','post','/login','loginForm','auth',
        [
            'state.authToken = action.payload.authToken',
            'state.user = action.payload.user',
            'state.appData = action.payload.appData'
        ],
        [ 'state.errorMessage = action.payload'])
    ->noAuth()
    ->service()
    ->resource('userAuth', 'UserAuth')
    ->method([ 'return $this->userAuth->login($request);' ]);

/**
 *
 *
 * Admin
 */
$admin = $app->component('Admin')
    ->style('padding', '15px')
    ->attribute('if', 'state.authToken');

/**
 *
 *
 * Operator
 */
$operator = $admin->component('Operator')
    ->attribute('if', 'state.user.role === 1');

$operator->component('ClientData')
    ->text('state.appData.operator.call.client.name')
    ->component('a')
        ->attribute('href', "'tel:' + state.appData.operator.call.client.phone")
        ->attribute('text', 'state.appData.operator.client.phone');

$callHistory = $operator->component('CallHistory');

$callScript = $operator->component('CallScript');


/**
 *
 *
 * Manager
 */
$manager = $admin->component('Manager')
    ->attribute('if', 'state.user.role === 2');

/**
 *
 * Main menu
 */
$menu = $manager->component('ManagerMenu')
    ->reducerButton('ManagerMenuContact', 'menu.contact', ['Kontakty', 'Contacts'], 'blue', ['state.section = 0'])
    ->reducerButton('ManagerMenuCampaign', 'menu.campaign', ['Kampaně', 'Campaigns'], 'blue', ['state.section = 1'])
    ->reducerButton('ManagerMenuCall', 'menu.call', ['Hovory', 'Calls'], 'blue', ['state.section = 2']);

/**
 *
 * Contact
 */
$contactSection = $manager->component('ContactSection')
    ->attribute('if', 'state.section === 0');

$contactSection->component('h1')
    ->attribute('lang', ['text', 'menu.contact']);

$contactSection->component('ContactListContainer')
    ->attribute('if', '!state.selectedContact.id')
    ->listComponent('Contact', 'state.appData.manager.contact')
    ->listItem('ContactListName')
        ->listItemText('item.name')
    ->listItem('ContactListPhone')
        ->listItemText('item.phone')
    ->listContainer()->clickReducer('selectContact', [ 'state.selectedContact = action.payload' ], 'item');

$contactSection->component('ContactDetailContainer')
    ->attribute('if', 'state.selectedContact.id')
    ->reducerButton('ContactCancel', 'selectedContact.cancel', ['Zrušit', 'Cancel'], 'grey', ['state.selectedContact.id = null'])
    ->input('ContactName', 'text', 'selectedContact.name', ['Jméno', 'Name'])
    ->input('ContactPhone', 'text', 'selectedContact.phone', ['Telefon', 'Phone'])
    ->input('ContactEmail', 'text', 'selectedContact.email', ['E-mail', 'E-mail'])
    ->button('ContactSave', 'selectedContact.save', ['Uložit', 'Save'], 'green')
    ->ajaxClick('putContact', 'put', '/contact', 'selectedContact', 'contact', [], [])
    ->saveItemReducer('selectedContact', 'appData.manager.contact', ['state.selectedContact.id = null'])
    ->service()
    ->resource('rest', 'Rest')
    ->restMethod('put', 'contact');

/**
 *
 * Campaign
 */
$campaignSection = $manager->component('CampaignSection')
    ->attribute('if', 'state.section === 1')
    ->text("'Kampaň'");


/**
 *
 * Call
 */
$campaignSection = $manager->component('CallSection')
    ->attribute('if', 'state.section === 2')
    ->text("'Hovory'");


$aps->execute();