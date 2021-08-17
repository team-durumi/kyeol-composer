
<div class="inner">
  <div class="cBody">
    <!-- con01 -->
    <div class="con01">
      <?php foreach($data['newsletters'] as $year => $newsletters): ?>
      <dl class="unit unit02">
        <dt><?php echo $year; ?></dt>
        <dd class="my-3 border-bottom py-3">
          <ul class="newsletters year-2020">
          <?php foreach($newsletters as $newsletter): ?>
            <li>
              <span class="date"><?php print $newsletter['date']; ?></span>
              <a target="_blank" href="<?php print $newsletter['origin_url'] ?>">
                <?php echo htmlspecialchars($newsletter['title']); ?>
              </a>
            </li>
          <?php endforeach; ?>
          </ul>
        </dd>
      </dl>
      <?php endforeach; ?>
    </div>
    <!-- //con01 -->
  </div>
</div>
