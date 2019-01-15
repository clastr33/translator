<div id="mainpage" class="container-fluid bg-grey">
  <div class="row">
    <div class="col-sm-3">
      <span class="glyphicon glyphicon-list-alt logo"></span>
    </div>
    <div class="col-sm-9   view_allwords">

        <h1>ALL WORDS</h1>

        <p>
        <?php

            foreach($data as $key => $value)
            {
                if($value != "===")
                    echo $key . " (" . $value . ")<br>";
                else
                    echo "<br>";
            }

        ?>
        </p>
        <p class="font-size07em">
            В языке много интересных и необычных слов, которые могут быть похожими на слова в русском по произношению, звучанию и написанию. Но много случаев, когда целые фразы не стоит переводить буквально. Поэтому лучше переводить не по словам, а по фразам.
        </p>
    </div>
  </div>
</div>

