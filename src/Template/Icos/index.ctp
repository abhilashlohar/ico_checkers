<div class="row py-3">
    <div class="col-md-12">
        <h3><?= __('Applications for ICO Review/Rating') ?></h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ICO Name</th>
                    <th>Link</th>
                    <th>Country</th>
                    <th>CEO/Founder Email</th>
                    <th>Applied on</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($icos as $ico): ?>
                <tr>
                    <td><?= h($ico->name) ?></td>
                    <td><?= h($ico->link) ?></td>
                    <td><?= h($ico->country) ?></td>
                    <td><?= h($ico->email) ?></td>
                    <td><?= h($ico->applied_on->format('d-m-Y h:i A')) ?></td>
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
