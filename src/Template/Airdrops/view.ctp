
<div class="airdrops view large-9 medium-8 columns content">
    <h3><?= h($airdrop->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($airdrop->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Link') ?></th>
            <td><?= h($airdrop->link) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= h($airdrop->country) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($airdrop->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($airdrop->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Applied On') ?></th>
            <td><?= h($airdrop->applied_on) ?></td>
        </tr>
    </table>
</div>
