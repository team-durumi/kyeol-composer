<div class="fc03" id="main-content">
    <div class="inner">
        <div class="cBody">
          <!-- con01 -->
          <div class="con01">
            <?php foreach($data['newsletters'] as $year => $newsletters): ?>
            <dl class="unit unit02">
              <dt><?php echo $year; ?></dt>
              <br/>
              <dd class="my-3 border-bottom py-3">
                <ul class="newsletters year-2020">
                <?php foreach($newsletters as $newsletter): ?>
                  <li>
                    <span class="date"><?php print $newsletter['date']; ?></span>
                    <a target="_blank" href="/sites/default/files/newsletters/<?php print $newsletter['directory'] ?>/">
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
      </section>

    </div>
</div>

<style>
.newsletters {list-style: none; padding: 0; margin: 0}
.newsletters li {list-style: none; padding: 0; margin: 0 0 1.5rem 0}
.newsletters li > a {
  font-size: 20px;
  line-height: 32px;
  color: #111;
  font-weight: 600;
  max-height: 64px;
  display: block;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
}
.newsletters li > .date {
  color: #888;
}
</style>
