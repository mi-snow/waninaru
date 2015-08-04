# waninaru
## 自分のアカウント名を入力してプルリクしてみよう♥♥♥♥

* chomesuke778
* nanahoshi9607
* reineko
* kurakk
* ichihara20
* wakabashi
* morimotyだよ
* mi131snow
* aotukihiragi

## github利用の流れ
### 編集するとき
1. 右上のSyncをクリックで更新する(アプリ)
2. masterdata_pushから新しいブランチを作成する(アプリ)
3. ファイルが追加されているので、コードを編集する(なんかのエディタなど)
4. changeタブの左からcommitを送信(アプリ)
5. 右上Publishの左隣にあるアイコンをクリックしてPull Requestを送信。Descriptionには編集内容を他の人が分かるように要約して入力(アプリ)
6. 他の人がこのプルリクを確認してレビューしたりマージしたり却下したりする。(ブラウザ)
7. ひと通り終了したら、ブランチは一応消しといてください。(アプリ)

### ブランチの消し方
1. Branchesタブを選択する
2. 一番上以外のブランチ(困ったらとりあえずmaster_pushで)の下三角のアイコンをクリック、Move to this branchを選択
3. 元いたブランチが一番上から下のどっかに移動するので、元のブランチの下三角のアイコンをクリックしてDeleteをクリック

すべてアプリ内の操作です。

### 他の人のアップロードを確認してクローンを作成するとき
1. GitHubフォルダ内のwaninaruフォルダを削除
2. アプリ上のwaninaruフォルダをremove(GitHubと書いてある方)
3. ブラウザからClone in Desktopを選択
4. アプリケーションの起動を選択
5. アプリケーション上でクローンが作成されたらFinderでWaninaruフォルダごとhtdocsのフォルダを置き換え。
6. MAMPを起動させwaninaruの現状を確認
7. データベースに接続されていないようならば、app/Config/database.phpでデータベースの接続を変更

## 参考リンク
* [2014年度夏コウサ todoアプリ班](https://github.com/takuminnnn/todo_app/wiki)