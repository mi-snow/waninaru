<?php echo $this->Html->css(array('howto'), null, array('inline'=>false));?>

<!-- ここから編集してください！！！！  -->
    <div id="main_container">

      <h2><span>Waninaruの使い方</span></h2>
      
      <div class="howto_container">

        <ul id="tab">
          <li class="select">企画を立てる</li>
          <li>企画に参加する</li>
        </ul>

        <div class="content_wrap">
          <div class="inner_contents">
            <p class="top_text">
              自分の趣味をもっと広げたい、自分の技術を発揮する場がほしい、やりたい事があるけど一人では出来るか不安だなあ、誰か一緒に勉強してくれないかなあ、 とこんなことを考えたり、感じたりしたことはありませんか？<br />
              あなたのそんな思いをぜひ企画化しみんなで共有し実現しましょう！
            </p>
            </dl>
          </div><!-- end inner_contents -->
          <div class="inner_contents">
            <dl class="clearfix back01">
              <dt><?php echo $this->Html->image('/app/webroot/img/howto/01_01.jpg',array()); ?></dt>
              <dd>
                <p>企画のタイトルを決める</p>
                <span>タイトルは企画の詳細で一番最初に目につくものになります。<br />
                  簡潔で一目見て内容がわかるものにしましょう。</span>
              </dd>
            </dl>
          </div><!-- end inner_contents -->
          <div class="inner_contents">
            <dl class="clearfix back02">
              <dt><?php echo $this->Html->image('/app/webroot/img/howto/01_02.jpg',array()); ?></dt>
              <dd>
                <p>企画の詳細を決める</p>
                <span>募集人数や開催日の日時、場所を決めます。<br />
                  自分の予定で開催出来る日に設定をし、<br />
                  その後参加者とコミュニケーションをとって<br />
                  要望に合わせてあげるのも良いかもしれません。</span>
              </dd>
            </dl>
          </div><!-- end inner_contents -->
          <div class="inner_contents">
            <dl class="clearfix back03">
              <dt><?php echo $this->Html->image('/app/webroot/img/howto/01_03.jpg',array()); ?></dt>
              <dd>
                <p>画像を選ぶ</p>
                <span>企画のイメージ画像は直観で興味を引く大きなポイントになります。<br />
                  タイトルや内容にぴったりの写真を選びましょう。</span>
              </dd>
            </dl>
          </div><!-- end inner_contents -->
          <div class="inner_contents">
            <dl class="clearfix back04">
              <dt><?php echo $this->Html->image('/app/webroot/img/howto/01_04.jpg',array()); ?></dt>
              <dd>
                <p>企画を投稿してイベントを実行しよう！</p>
                <span>初対面の方が多かったり、開催することに緊張などもあると思いますが、<br />
                  自分の企画を実現出来るせっかくの機会です。<br />
                  参加者みんなと思う存分楽しみましょう！</span>
              </dd>
            </dl>
          </div><!-- end inner_contents -->
        </div><!-- end content_wrap -->




        <div class="content_wrap disnon">
          <div class="inner_contents">
            <p class="top_text">
              waninaruでは「企画者」と「参加者」がいます。「企画者」が考えたイベントや勉強会、催しなどに楽しそう！と思ったり新しいことに挑戦したいなと賛同して参加するのが参加者です。<br />
              あなたのそんな思いをぜひ企画化しみんなで共有し実現しましょう！
            </p>
            </dl>
          </div><!-- end inner_contents -->
          <div class="inner_contents">
            <dl class="clearfix back01">
              <dt><?php echo $this->Html->image('/app/webroot/img/howto/02_01.jpg',array()); ?></dt>
              <dd>
                <p>気になる企画を見つける</p>
                <span>TOPページの新着企画や、気になるキーワードから検索して、<br />
                  自分の興味のある企画を探してみましょう。</span>
              </dd>
            </dl>
          </div><!-- end inner_contents -->
          <div class="inner_contents">
            <dl class="clearfix back02">
              <dt><?php echo $this->Html->image('/app/webroot/img/howto/02_02.jpg',array()); ?></dt>
              <dd>
                <p>共感した企画に参加しよう！</p>
                <span>気になる企画を見つけたら詳細画面から<br />
                  日時や必要事項を確認し条件に合えば、参加してみましょう。<br />
                  コメントを投稿して質問するなど企画者と<br />
                  コミュニケーションをとる事も出来ます。</span>
              </dd>
            </dl>
          </div><!-- end inner_contents -->
          <div class="inner_contents">
            <dl class="clearfix back03">
              <dt><?php echo $this->Html->image('/app/webroot/img/howto/02_03.jpg',array()); ?></dt>
              <dd>
                <p>企画を共有して輪を広げよう</p>
                <span>企画に参加し、スキル共有やイベントなどを通して<br />
                  ネットワーク情報学部生と繋がっていきましょう！<br />
                  繋がりを広げて大きな「輪になる」ことが出来るかもしれません。</span>
              </dd>
            </dl>
          </div><!-- end inner_contents -->
        </div>
      </div><!-- end howto_container -->
      
    </div><!-- end main_container -->




    <script type="text/javascript">
      $(function() {
          $("#tab li").click(function() {
              var num = $("#tab li").index(this);
              $(".content_wrap").addClass('disnon');
              $(".content_wrap").eq(num).removeClass('disnon');
              $("#tab li").removeClass('select');
              $(this).addClass('select')
          });
      });
    </script>



    <!-- 編集ここまで  -->