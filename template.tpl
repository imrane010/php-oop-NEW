<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Character Info</title>
</head>
<body>
<h1>Character: {$hero->getName()}</h1>
<p>Role: {$hero->getRole()}</p>
<p>Health: {$hero->getHealth()}</p>
<p>Attack: {$hero->getAttack()}</p>
<p>Defense: {$hero->getDefense()}</p>
<p>Range: {$hero->getRange()}</p>
</body>
</html>
{extends file="layout.tpl"}

{block name="content"}
    <h2>Character List</h2>

    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Role</th>
            <th>Health</th>
            <th>Attack</th>
            <th>Defense</th>
            <th>Range</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        {foreach $characters as $character}
            <tr>
                <td>{$character->getName()}</td>
                <td>{$character->getRole()}</td>
                <td>{$character->getHealth()}</td>
                <td>{$character->getAttack()}</td>
                <td>{$character->getDefense()}</td>
                <td>{$character->getRange()}</td>
                <td><!-- Acties komen later --></td>
            </tr>
        {/foreach}
        </tbody>
    </table>
{/block}
{extends file="layout.tpl"}

{block name="content"}
    <h1>Welkom bij de RPG Game</h1>
    <p>Deze game stelt je in staat om personages aan te maken, te bekijken en te beheren.</p>
    <p>Gebruik het menu om te beginnen!</p>
{/block}
<td>
    <a href="index.php?page=viewCharacter&name={$character->getName()}" class="btn btn-info btn-sm">View</a>
    <a href="index.php?page=deleteCharacter&name={$character->getName()}" class="btn btn-danger btn-sm">Delete</a>
</td>
{extends file="layout.tpl"}

{block name="content"}
    <h2>Character Details</h2>
    <ul class="list-group">
        <li class="list-group-item"><strong>Name:</strong> {$character->getName()}</li>
        <li class="list-group-item"><strong>Role:</strong> {$character->getRole()}</li>
        <li class="list-group-item"><strong>Health:</strong> {$character->getHealth()}</li>
        <li class="list-group-item"><strong>Attack:</strong> {$character->getAttack()}</li>
        <li class="list-group-item"><strong>Defense:</strong> {$character->getDefense()}</li>
        <li class="list-group-item"><strong>Range:</strong> {$character->getRange()}</li>
    </ul>
    <br>
    <a href="index.php?page=characterList" class="btn btn-secondary">← Terug naar lijst</a>
{/block}
<a class="nav-link" href="index.php">Home</a>
<a class="nav-link" href="index.php?page=createCharacter">Create Character</a>
<a class="nav-link" href="index.php?page=characterList">Character List</a>
<form method="post" action="index.php?page=saveCharacter">
