<footer class="footer">
      <div class="content has-text-centered" style="font-size:0.9em;">
        <a href="https://www.owasp.org/www-project-timegap-theory/">OWASP</a> | <a href="//timegaptheory.com">TimeGap Theory</a> | <a href="https://en.wikipedia.org/wiki/Time-of-check_to_time-of-use">TOCTOU</a> | <a href="https://resources.securitycompass.com/blog/moving-beyond-the-owasp-top-10-part-1-race-conditions-2">Race Condition</a><br>
        <br>
        <a id="snow" onclick="togglesnow();">Snow off</a> | <a id="darkb" onclick="toggleDark();">Dark mode off</a>
        <?php require_once dirname( __FILE__ ) . '/' . '../score/track.php'; ?>
      </div>
    </footer>
      <script><?php require_once dirname( __FILE__ ) . '/../' . 'common/snow.js'; ?></script>
      <script><?php require_once dirname( __FILE__ ) . '/../' . 'common/dark.js'; ?></script>