<template>
    <div class="calendar d-flex flex-column">
        <h1 class="text-center"> Система бронирования </h1>
        <div class="infoBlock d-flex flex-row justify-content-around">
            <div class="sBlock d-flex flex-row align-items-center">
                <span class="red"> </span> <span> -  забронирован </span>
            </div>
            <div class="sBlock d-flex flex-row align-items-center">
                <span class="green"> </span> <span> -  выбран </span>
            </div>
        </div>
        <div class="month">
            <h3 class="text-center"> Март 2022 </h3>
        </div>
        <div class="mainBlock">
            <dayComponent></dayComponent>
        </div>
        
    </div>
</template>


<script>
    
import dayComponent from './DayComponent'

    
export default {
    name: 'Calendar',
    components: {
        dayComponent
    },
    data(){
        return{
            
        }
    },
    mounted() {
        
    },
    methods:{
        
    }
}
</script>

<style>
    .calendar{
        background-color: #ecf0f1;
        padding: 30px;
        min-width: 500px;
        width: 75%;
    }
    
    /* Информационный блок с цветом ячеек   */
    .calendar .infoBlock{
        margin: 20px auto 0;
        min-width: 320px;
        width: 50%;
    }
    .calendar .infoBlock div .red, .calendar .infoBlock div .green{
        width: 30px;
        height: 30px;
        margin-right: 10px;
        background-color: #e84c3d;
    }
    .calendar .infoBlock div .green{
        background-color: #36c072;
    }
    
        /* Блок с выводом месяца   */
    .calendar .month{
        margin-top: 20px;
    }
    
    .calendar .mainBlock{
        margin-top: 20px;
    }
    
    @media screen and (max-width: 640px) {
        .calendar{
             min-width: 100%;   
        }
        .calendar .infoBlock{
            min-width: 100%;
        }
        .calendar .infoBlock div span{
            font-size: 12px;
        }
        .calendar .infoBlock div .red, .calendar .infoBlock div .green{
            width: 20px;
            height: 20px;
        }
        
    }

</style>
