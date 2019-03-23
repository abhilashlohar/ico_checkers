<div class="row py-3">
  <div class="col-md-12">
    <table class="table">
      <thead>
        <tr>
          <th>Time</th>
          <th>News</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($news as $news): ?>
        <tr>
          <td><?= $this->Number->format($news->created_by) ?></td>
          <td><?= h($news->title) ?></td>
          <td></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

