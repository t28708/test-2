<template>
   <div class="container-fluid">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h3 v-if="result == false">{{question.title}} </h3>
               <h3 v-else>Вы уже проголосвали</h3>
            </div>
            <div class="modal-body">
               <template v-if="result == false">
                  <div
                     class="quiz"
                     id="quiz"
                     data-toggle="buttons"
                     v-for="(textInput, idx) of question.textInputs"
                     @key="idx"
                     >
                     <label class="element-animation1 btn btn-lg btn-primary btn-block">
                     <span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span>
                     <input
                        type="radio"
                        name="q_answer"
                        :value="textInput.label"
                        v-model="picked"
                        @change.prevent="answerId=textInput.id;"
                        >{{textInput.label}}</label>
                  </div>
                  <input v-if="answerId == 2"
                     class="publisher-input"
                     type="text"
                     placeholder="Тогда кто ВЫ?"
                     v-model="picked"
                     >
                  <input type="submit" value="Отправить" class="btn btn-danger form-control" @click.prevent="sendAnswer()">
               </template>
            </div>
            <div v-if="result == true" class="modal-footer text-muted">
               <span id="answer">Спасибо за ваш ответ - {{picked}}</span>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
// Пояснение.
// Защита от ПОВТОРНОГО голосовая путём удаления LocalStorage не сработает. То есть удалив localstorage можно голосовать повторно.
// Но мы вроде как зарегистрированы. Но опрос анонимный, так как я не создал поле user_id с привязкой к таблице user LARAVEl
// По-хорошему надо тянуть ОПРОС из БД, но это тестовое.
// Данные сейчас сохраняются в БД. Можно при помощи бэка их вытащить, в беке отсортировать и посчитать.
// И вывести сколько "кого" после голосования

// Не готова переброска на страницу после авторизации.

    export default {        

        data(){
            return {

                question: { // по идее должны с бека получать ПРОПСАМИ

                  title: "Ваша роль в компании?",
                  id:0,
                  
                  textInputs: [
                    {
                      label: "Frontend разработчик",
                      id: 0,
                    },
                    {
                      label: "Backend разработчик",
                      id: 1,
                    },
                    {
                      label: "Что-то другое",
                      id: 2,
                    },

                  ],
                  
                },

                picked:'',

                answerId:0,

                result:false,               
           
            }
        },

        mounted() {
            const resultList = localStorage.getItem("result");

            if (resultList) {
                this.result = true;
                this.picked = resultList; 
            }

            console.log(resultList) ;
        },

        methods: {

            async sendAnswer() {
            
                let form = new FormData();
                form.append('body', this.picked);

                await axios.post('/opros/send', form)
                    .then((response) => { 

                        if (response.data == false) {
                            window.location.href = "/login"
                        }   else {            

                        localStorage.setItem("result", JSON.stringify(this.picked));
                        this.result = true;

                        }

                        console.log(response);

                    })

                    .then(result => {
                        //чтобы было
                    })

                    .catch((error) => {
                        console.log(error);
                    });

            },           

        },

        watch: {
            answerId() {

                if (this.answerId == 2 ) { // коряво, но работает в данном ТЗ
                    this.picked = '';
                }
            }
        },
    }
</script>