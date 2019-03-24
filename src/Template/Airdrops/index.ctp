<div class="row py-3">
    <div class="col-md-12">
        <h3><?= __('Airdrops') ?></h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ICO Name</th>
                    <th>Link</th>
                    <th>Country</th>
                    <th>CEO/Founder Email</th>
                    <th>Created on</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($airdrops as $airdrop): ?>
                <tr>
                    <td><?= h($airdrop->name) ?></td>
                    <td><?= h($airdrop->link) ?></td>
                    <td><?= h($airdrop->country) ?></td>
                    <td><?= h($airdrop->email) ?></td>
                    <td><?= h($airdrop->created_on->format('d-m-Y h:i A')) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    </div>
</div>
