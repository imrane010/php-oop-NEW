<?php
require_once 'vendor/autoload.php';

use Game\Character;
use Game\CharacterList;
use Smarty;

session_start();

$characterList = $_SESSION['characterList'] ?? new CharacterList();

$template = new Smarty();
$template->setTemplateDir('templates');

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'createCharacter':
        $template->display('createCharacterForm.tpl');
        break;

    case 'saveCharacter':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $role = $_POST['role'];
            $health = (int) $_POST['health'];
            $attack = (int) $_POST['attack'];
            $defense = (int) $_POST['defense'];
            $range = (int) $_POST['range'];

            $character = new Character($name, $role, $health, $attack, $defense, $range);
            $characterList->addCharacter($character);

            $template->assign('character', $character);
            $template->display('characterCreated.tpl');
        }
        break;

    case 'characterList':
        $template->assign('characters', $characterList->getCharacters());
        $template->display('characterList.tpl');
        break;

    case 'viewCharacter':
        $name = $_GET['name'] ?? '';
        $character = $characterList->getCharacter($name);

        if ($character instanceof Character) {
            $template->assign('character', $character);
            $template->display('character.tpl');
        } else {
            echo $character;
        }
        break;

    case 'deleteCharacter':
        $name = $_GET['name'] ?? '';
        $character = $characterList->getCharacter($name);

        if ($character instanceof Character) {
            $characterList->removeCharacter($character);
        }
        header('Location: index.php?page=characterList');
        exit;

    default:
        $template->display('home.tpl');
        break;
}

$_SESSION['characterList'] = $characterList;
