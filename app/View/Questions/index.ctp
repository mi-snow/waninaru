<!-- faq.css を使用してください！ -->
<?php echo $this->Html->css(array('faq'), null, array('inline'=>false));?>

<div id="main_container">

  <h2><span>よくあるご質問</span></h2>
  
  <div class="faq_container">
    <h3 id="no1">サービス全般</h3>
    <dl>
      <dt class="clearfix"><span>Q</span><p>Waninaruとはどのようなサービスですか？</p></dt>
      <dd class="clearfix"><span>A</span><p>Waninaruは、誰でも企画をたてることができ、また参加する事ができる企画支援サービスです。</p></dd>
    </dl>
    <dl>
      <dt class="clearfix"><span>Q</span><p>Waninaruは誰でも参加できますか？</p></dt>
      <dd class="clearfix"><span>A</span><p>ネットワーク情報学生なら誰でも参加する事ができます。</p></dd>
    </dl>
    <dl>
      <dt class="clearfix"><span>Q</span><p>ユーザー登録を行いたいです。</p></dt>
      <dd class="clearfix"><span>A</span><p>2014年度の1年生の方には、アカウントをこちらで全て作成しています。<br />
        他学年の方でユーザー登録をご希望の方は、<?php echo $this->Html->link('運営までお問い合わせ下さい' , array('controller'=>'contacts' , 'action'=>'index'),array('title'=>'お問い合わせ') ) ?>。</p></dd>
    </dl>
    <dl>
      <dt class="clearfix"><span>Q</span><p>退会するには？</p></dt>
      <dd class="clearfix"><span>A</span><p>退会をご希望の方は、お手数ですが<?php echo $this->Html->link('運営までお問い合わせ下さい' , array('controller'=>'contacts' , 'action'=>'index'),array('title'=>'お問い合わせ') ) ?>。<br />※2014年度の1年生の方は、入門ゼミナールの授業が完全に終了してから、退会が可能となります。</p></dd>
    </dl>
  </div><!-- end faq_container -->

  <div class="faq_container">
    <h3>企画を投稿するにあたって</h3>
    <dl>
      <dt class="clearfix"><span>Q</span><p>企画の開催場所はどうやって探せばいいですか？</p></dt>
      <dd class="clearfix"><span>A</span><p>企画を実行するのに適した開催場所を参加人数、企画の内容を考え、選択しましょう。学内であれば、1号館4FにあるDS（ディスカッションスペース）のような公共で使える場を利用することをおすすめします。その際、その他の利用者に迷惑のかからない使い方をする必要があります。また、許可を取る必要のある場所での開催を行う場合には、各施設の管理者に許可を取り適切な使い方をする必要があります。 </p></dd>
    </dl>
    <dl>
      <dt class="clearfix"><span>Q</span><p>諸経費が発生する企画をたてることはできますか？</p></dt>
      <dd class="clearfix"><span>A</span><p>可能です。ただし、「開催するために材料費・施設費が必要」など、経費発生の理由および使用用途を明記し、企画者に利益が発生しないものである必要があります。 </p></dd>
    </dl>
    <dl>
      <dt class="clearfix"><span>Q</span><p>企画するために注意すべきことはありますか？</p></dt>
      <dd class="clearfix"><span>A</span><p>参加者および企画の管理をする必要があります。また、禁則事項にあてはまる企画や他の会員や第三者に迷惑のかかるおそれのある企画の立案を行う事はできません。</p></dd>
    </dl>
  </div><!-- end faq_container -->

  <div class="faq_container">
    <h3>企画に参加するにあたって</h3>
    <dl>
      <dt class="clearfix"><span>Q</span><p>企画者と連絡をとるには？</p></dt>
      <dd class="clearfix"><span>A</span><p>Waninaru上では、コメント欄を通して企画者と連絡をとる事が可能となっています。</p></dd>
    </dl>
    <dl>
      <dt class="clearfix"><span>Q</span><p>参加を取り消すには？</p></dt>
      <dd class="clearfix"><span>A</span><p>参加している企画詳細ページから、「参加を取り消す」ボタンを押してください。  </p></dd>
    </dl>
  </div><!-- end faq_container -->
  
</div><!-- end main_container -->