<template>
    
    <div class="calendarTable">
       <div class="">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col"> пн </th>
                        <th scope="col"> вт </th>
                        <th scope="col"> ср </th>
                        <th scope="col"> чт </th>
                        <th scope="col"> пт </th>
                        <th scope="col"> сб </th>
                        <th scope="col"> вс </th>
                    </tr>
                </thead>
                <tbody >
                    <tr v-for="(val, item) in freeM" 
                       v-html="val"
                       @click="clickFor">

                    </tr>
                </tbody>
            </table>
       </div>
        <div class="btnBlock">
            <a href="#"
                v-if="isActive"
                @click="updateData"
            > 
                Забронировать 
            </a>
            <p v-if="isText"> Бронирование успешно завершено </p>
        </div>
    </div>
</template>

<script>
    
import axios from 'axios';

export default{
    name: 'DayComponent',
    data(){
        return{
            isActive: false,
            isText: false,
            currentMontd: 31,   // максимально дней в месяце
            lastMontd: 28,      // максимально дней в прошедшем месяце
            nextMontd: 30,      // максимально дней в следующем месяце
            countLM: 1,         // показать количество дней из предыдущего месяца
            countNM: 10,        // показать количество дней из следующего месяца
            countDay: 7,        // количество дней в недели
            reservetDay: [],    // сохраняем зарезервироанные дни из БД
            dataReserve: [],    // сохраняем дни которые хотим зарезервировать
        }
    },
    mounted(){
        //получаем зарезервированные дни из БД
        this.getData('03.2022');
    },
    methods:{
        
        /**
        * Помечаем выбранные дни для резервирования
        */
        clickFor(event)
        {
            
            let elemet = event.target.classList;
            
            if(elemet.contains('booked') || elemet.contains('noMonth'))
            {
                // При клике, выводим модальное окно, что дата не доступна
                //alert('Выбранная дата не доступна');
            }else
            {
                event.target.classList.toggle("reserver");
                
                // метод отслеживания резерва
                this.isElementInArray(event.target.innerText);
            }
            // проверяем показывать ли кнопку "бронирования"
            this.dataReserve.length != 0 ? this.isActive = true : this.isActive = false;
            
        },
        
        /**
        * Резервируем выбранные дни
        */
        isElementInArray(elem)
        {
            let element = Number(elem);
            
            if(this.dataReserve.indexOf(element) != -1){
                 this.dataReserve =  this.dataReserve.filter(e => e != element);
            }else
            {
                this.dataReserve.push(element);
            }
        },
        
        /**
        * Получаем дни которые уже были зарезервированны
        */
        getData(tMonth)
        {
            axios('api/bookedDay/' + tMonth,{
                method: "GET",
            })
            .then(response => {
                return this.reservetDay = response.data;
            })
            .catch(err => {
                console.log(err.data);
            });
        },
        
        /**
        * Сохраняем выбранные даты
        */
        updateData()
        {
            //Объеденям два массива
            this.reservetDay.push(...this.dataReserve);
            
            // обнуляем массив
            this.dataReserve = [];
            
            let dat = '03.2022';
            
            //отправляем данные для сохранения резерва
            return axios('api/bookedDay/' + dat,{
                method: "PUT",
                params:{
                    booked_day: this.reservetDay,
                },
            })
            .then(response => {
                this.isActive = false;
                this.isText = true;
            })
            .catch(err => {
                console.log(err.data);
            });
        }
    },
    computed:{
        
        /** 
        * Формируем вывод таблицы месяца
        */
        freeM()
        {
            let arr = [];       // основной массив для вывода сформированных дней
            let tmp_arr = '';   // временно храним неделю
            let meter = 0;      // счётчик дня 
            
            //  прошедший месяц
            for(let day = this.lastMontd - this.countLM; day < this.lastMontd; day ++)
            {
                tmp_arr += "<td class='noMonth'>" + (day + 1) + "</td>";
                meter ++;   // считаем дни
                // если дни заполнились, соъраняем и очищаем
                if(meter == this.countDay)
                {
                    arr.push(tmp_arr);
                    meter = 0;
                    tmp_arr = '';
                }
            }
            
            // текущий месяц
            for(let day = 1; day <= this.currentMontd; day ++)
            {
                
                if(this.reservetDay.indexOf(day) != -1)
                {
                    tmp_arr += "<td class='booked' title='день забронирован'>" + day + "</td>";  
                }else{
                    tmp_arr += "<td class='month' title='день свободен'>" + day + "</td>";
                }
                
                meter ++;
                
                // если дни заполнились, соъраняем и очищаем
                if(meter == this.countDay)
                {
                    arr.push(tmp_arr);
                    meter = 0;
                    tmp_arr = '';
                }
            }
            
            // следующий месяц
            for(let day = 1; day <= this.countNM; day ++)
            {
                tmp_arr += "<td class='noMonth'>" + day + "</td>";
                meter ++;
                
                // если дни заполнились, соъраняем и очищаем
                if(meter == this.countDay)
                {
                    arr.push(tmp_arr);
                    meter = 0;
                    tmp_arr = '';
                }
            }
            
            arr.push(tmp_arr);
            
            return arr;
        }
    }
}
    
</script>

<style>
    .calendarTable{
        display: flex;
        flex-direction: row;
        justify-content: center;
        
    }
    /*  Стили таблицы  */
    .calendarTable .table tbody .month:hover{
        cursor: pointer;
        color: #36c072;
    }
    
    .calendarTable .table tbody .noMonth{
        color: #D3D3D3;
    }
    
    .calendarTable .table tbody .booked{
        background-color: #e84c3d;
        color: #fff;
    }
    .calendarTable .table tbody .reserver{
        background-color: #36c072;
        color: #fff;
    }
    .calendarTable .table tbody .reserver:hover{
        color: #FFFF00;
    }
    
    /* Стили с кнопкой   */
    .calendarTable .btnBlock{
        display: flex;
        align-items: center;
    }
    .calendarTable .btnBlock p{
        margin-left: 70px;
        color: #36c072;
        font-weight: bold;
    }
    .calendarTable .btnBlock a{
        color: #fff;
        margin-left: 70px;
        background: linear-gradient(180deg, #42f18c, #36c072);
        padding: 5px 10px;
        text-decoration: none;
    }
    .calendarTable .btnBlock a:hover{
        background: linear-gradient(0deg, #42f18c, #36c072);
    }
    
    @media screen and (max-width: 640px) {
        .calendarTable{
            flex-direction: column;
            justify-content: center;        
        }
        
        .calendarTable .table{
            margin: 0 auto 20px;
            width: 240px;
        }
        
        .calendarTable .btnBlock a, .calendarTable .btnBlock p{
            margin: 0 auto;
        }
        
    }
    
</style>