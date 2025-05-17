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
    <!-- templates/createCharacterForm.tpl -->

    <form method="POST" action="index.php?page=saveCharacter">
        <!-- bestaand formulier -->

        <div id="rageField" style="display:none;">
            <label for="rage">Rage:</label>
            <input type="number" name="rage" id="rage" min="0" max="100">
        </div>

        <div id="manaField" style="display:none;">
            <label for="mana">Mana:</label>
            <input type="number" name="mana" id="mana" min="0" max="100">
        </div>

        <script>
            function toggleFields() {
                var role = document.getElementById('role').value;
                document.getElementById('rageField').style.display = (role === 'Warrior') ? 'block' : 'none';
                document.getElementById('manaField').style.display = (role === 'Mage') ? 'block' : 'none';
            }

            document.getElementById('role').addEventListener('change', toggleFields);
            toggleFields(); // Initialiseren bij laden van de pagina
        </script>
    </form>
    <!-- templates/character.tpl -->

    <h2>{$character->getName()}</h2>
    <p>Role: {$character->getRole()}</p>
    <p>Health: {$character->getHealth()}</p>
    <p>Attack: {$character->getAttack()}</p>

    {if $character->getRole() == 'Warrior' && $character->getRage() !== null}
        <p>Rage: {$character->getRage()}</p>
    {/if}

    {if $character->getRole() == 'Mage' && $character->getMana() !== null}
        <p>Mana: {$character->getMana()}</p>
    {/if}

    <a href="index.php?page=characterList">← Back to character list</a>
    <div class="mb-3" id="energyField" style="display: none;">
        <label for="energy">Energy:</label>
        <input type="number" class="form-control" id="energy" name="energy" min="75" max="150" value="100" required>
    </div>
    <script>
        function toggleFields() {
            var role = document.getElementById('role').value;
            document.getElementById('rageField').style.display = (role === 'Warrior') ? 'block' : 'none';
            document.getElementById('manaField').style.display = (role === 'Mage') ? 'block' : 'none';
            document.getElementById('energyField').style.display = (role === 'Rogue') ? 'block' : 'none';
        }

        document.getElementById('role').addEventListener('change', toggleFields);
        toggleFields(); // initial state
    </script>
    <a href="index.php?page=resetStats" class="btn btn-danger">Reset Statistics</a>
    <a href="index.php?page=recalculateStats" class="btn btn-primary">Recalculate Statistics</a>
    <p>Total Characters: {$totalCharacters}</p>

    <p>Names:</p>
    <ul>
        {foreach $existingNames as $name}
            <li>{$name}</li>
        {/foreach}
    </ul>

    <p>Character Types and counts:</p>
    <ul>
        {foreach from=$typeCounts key=type item=count}
            <li>{$type}: {$count}</li>
        {/foreach}
    </ul>
    <div id="shieldField" style="display:none;">
        <label for="shield">Shield durability:</label>
        <input type="number" name="shield" id="shield" value="50" min="0" />
    </div>
    <option value="Tank">Tank</option>
    <script>
    function toggleFields() {
    const role = document.getElementById('role').value;
    const shieldField = document.getElementById('shieldField');
    shieldField.style.display = (role === 'Tank') ? 'block' : 'none';
    }
    document.getElementById('role').addEventListener('change', toggleFields);
    toggleFields(); // initial call
    </script>