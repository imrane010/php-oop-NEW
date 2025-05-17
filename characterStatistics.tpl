{extends file="layout.tpl"}

{block name="content"}
    <h2>Character Statistics</h2>

    <p>Totaal aantal characters: {$totalCharacters}</p>

    <h3>Aantal per type</h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Character Type</th>
            <th>Aantal</th>
        </tr>
        </thead>
        <tbody>
        {foreach $characterTypeCounts as $type => $count}
            <tr>
                <td>{$type}</td>
                <td>{$count}</td>
            </tr>
        {/foreach}
        </tbody>
    </table>

    <h3>Alle namen</h3>
    <ul class="list-group">
        {foreach $existingNames as $name}
            <li class="list-group-item">{$name}</li>
        {/foreach}
    </ul>
{/block}
<li class="nav-item">
    <a class="nav-link" href="index.php?page=characterStats">Character Statistics</a>
</li>
{extends file="layout.tpl"}

{block name="content"}
    <h2>Character Statistics</h2>

    <p>Totaal aantal characters: {$totalCharacters}</p>

    <h3>Aantal per type</h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Character Type</th>
            <th>Aantal</th>
        </tr>
        </thead>
        <tbody>
        {foreach $typeCounts as $type => $count}
            <tr>
                <td>{$type}</td>
                <td>{$count}</td>
            </tr>
        {/foreach}
        </tbody>
    </table>

    <h3>Alle namen</h3>
    <ul class="list-group">
        {foreach $existingNames as $name}
            <li class="list-group-item">{$name}</li>
        {/foreach}
    </ul>

    <div class="mt-3">
        <a href="index.php?page=resetStats" class="btn btn-danger me-2">Reset Statistics</a>
        <a href="index.php?page=recalculateStats" class="btn btn-primary">Recalculate Statistics</a>
    </div>
{/block}
