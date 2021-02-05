<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 06.02.2021
 * Time: 0:25
 */

namespace App;


use App\Code\Component;
use App\Code\FullStack;

class Process
{

    /**
     * @param Component $app
     */
    public function Langs(Component $app)
    {
        $app
            ->component('Langs')
            ->reducerButton('CzLang', 'langs.cz', ['Czech', 'Česky',], 'grey', ['state.activeLang = 0'])
            ->reducerButton('EnLang', 'langs.en', ['English', 'Anglicky'], 'grey', ['state.activeLang = 1']);
    }


    /**
     * @param Component $app
     */
    public function LoginForm(Component $app)
    {
        $app
            ->component('LoginForm')
            ->attribute('if', '!state.authToken')
            ->langElement('h1', ['text', 'loginForm.header', ['Přihlašovací formulář', 'Login form']])
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
    }


    /**
     * @param Component $app
     * @return Component
     */
    public function Admin(Component $app)
    {
        return $app
            ->component('Admin')
            ->attribute('if', 'state.authToken');
    }


    /**
     * @param Aps $aps
     * @return Component
     */
    public function init(Aps $aps)
    {
        $fullStack = $aps->fullStack();

        $fullStack
            ->config('apiUrl', 'http://localhost:8080')
            ->state('authToken', null)
            ->state('preloader', false)
            ->state('lang', [])
            ->state('activeLang', 0)
            ->state('section', 0);

        return $fullStack->component('App');
    }


    /**
     * @param Component $admin
     * @return Component
     */
    public function Operator(Component $admin)
    {
        return $admin
            ->component('Operator')
            ->attribute('if', 'state.user.role === 1');
    }


    /**
     * @param Component $operator
     */
    public function ClientData(Component $operator)
    {
        $operator
            ->component('ClientData')
            ->text('state.appData.operator.call.client.name')
            ->component('a')
            ->attribute('href', "'tel:' + state.appData.operator.call.client.phone")
            ->attribute('text', 'state.appData.operator.client.phone');

    }


    /**
     * @param Component $operator
     * @return Component
     */
    public function CallHistory(Component $operator)
    {
        return $operator->component('CallHistory');
    }


    /**
     * @param Component $operator
     * @return Component
     */
    public function CallScript(Component $operator)
    {
        return $operator->component('CallScript');
    }


    /**
     * @param Component $admin
     * @return Component
     */
    public function Manager(Component $admin)
    {
        return $admin
            ->component('Manager')
            ->attribute('if', 'state.user.role === 2');

    }


    /**
     * @param Component $manager
     */
    public function ManagerMenu(Component $manager)
    {
        $manager
            ->component('ManagerMenu')
            ->reducerButton('ManagerMenuContact', 'menu.contact', ['Kontakty', 'Contacts'], 'blue', ['state.section = 0'])
            ->reducerButton('ManagerMenuCampaign', 'menu.campaign', ['Kampaně', 'Campaigns'], 'blue', ['state.section = 1'])
            ->reducerButton('ManagerMenuCall', 'menu.call', ['Hovory', 'Calls'], 'blue', ['state.section = 2']);
    }


    /**
     * @param Component $manager
     */
    public function ContactSection(Component $manager)
    {
        $contactSection = $manager
            ->component('ContactSection')
            ->attribute('if', 'state.section === 0')
            ->langElement('h1', ['text', 'menu.contact']);

        $contactSection
            ->component('ContactListContainer')
            ->attribute('if', '!state.selectedContact.id')
            ->listComponent('Contact', 'state.appData.manager.contact')
            ->listItemText('ContactListName', 'item.name')
            ->listItemText('ContactListPhone', 'item.phone')
            ->listContainer()->clickReducer('selectContact', [ 'state.selectedContact = action.payload' ], 'item');


        $contactSection
            ->component('ContactDetailContainer')
            ->attribute('if', 'state.selectedContact.id')
            ->reducerButton('ContactCancel', 'selectedContact.cancel', ['Zrušit', 'Cancel'], 'grey', ['state.selectedContact.id = null'])
            ->input('ContactName', 'text', 'selectedContact.name', ['Jméno', 'Name'])
            ->input('ContactPhone', 'text', 'selectedContact.phone', ['Telefon', 'Phone'])
            ->input('ContactEmail', 'text', 'selectedContact.email', ['E-mail', 'E-mail'])
            ->saveItemButton('Contact', 'appData.manager.contact');

    }


    /**
     * @param Component $manager
     */
    public function CampaignSection(Component $manager)
    {
        $campaignSection = $manager
            ->component('CampaignSection')
            ->attribute('if', 'state.section === 1')
            ->langElement('h1', ['text', 'menu.campaign']);

        $campaignSection
            ->component('CampaignListContainer')
            ->attribute('if', '!state.selectedCampaign.id')
            ->listComponent('Campaign', 'state.appData.manager.campaign')
            ->listItemText('CampaignListName', 'item.name')
            ->listContainer()->clickReducer('selectCampaign', [ 'state.selectedCampaign = action.payload' ], 'item');

        $campaignSection
            ->component('CampaignDetailContainer')
            ->attribute('if', 'state.selectedCampaign.id')
            ->reducerButton('CampaignCancel', 'selectedCampaign.cancel', ['Zrušit', 'Cancel'], 'grey', ['state.selectedCampaign.id = null'])
            ->input('CampaignName', 'text', 'selectedCampaign.name', ['Název', 'Name'])
            ->saveItemButton('Campaign', 'appData.manager.campaign');

    }


    /**
     * @param Component $manager
     */
    public function CallSection(Component $manager)
    {
        $campaignSection = $manager
            ->component('CallSection')
            ->attribute('if', 'state.section === 2')
            ->text("'Hovory'");

    }
}