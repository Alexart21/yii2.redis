<?php
$csrf_param = Yii::$app->request->csrfParam;
$csrf_token = Yii::$app->request->csrfToken;
?>
<button id="test-bt" class="btn btn-succes">AXIOS</button>
<br>
<br>
<button id="test-bt2" class="btn btn-succes">FETCH</button>
<script>
   const axiosBt = document.getElementById('test-bt');
   const fetchBt = document.getElementById('test-bt2');

   const url = '/test/axios';
   let formData = new FormData();
   formData.append('<?= $csrf_param ?>', '<?= $csrf_token ?>');
   formData.append('q', 'бла-бла');

   axiosBt.onclick = () => {
       axios.post(url, formData)
           .then(function (response) {
               // обработка успешного запроса
               // console.log(response);
               console.log(response.data);
           })
           .catch(function (error) {
               // обработка ошибки
               console.log(error.response.status);
               console.log(error.response.headers);
               console.log(error.response.data);
           })
           .then(function () {
               console.log('выполняется всегда');
           });
   }
   //

   fetchBt.onclick = () => {
       let response = fetch(url, {
             method: 'POST',
             body: formData,
             headers: {
               // значение этого заголовка обычно ставится автоматически,
               // в зависимости от тела запроса
               // "Content-Type": "text/plain;charset=UTF-8"
            },
         }).then(function (response) {
             response.json().then(function (data) {
                 if(response.ok){
                     // console.log(JSON.parse(data).name);
                     console.log(data);
                 }else{
                     console.log(response)
                 }
             });
         });
   }
</script>