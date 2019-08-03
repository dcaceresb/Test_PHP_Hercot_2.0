<template>
    
    <div class="container">
        <h2 class="text-center">Historial de citas</h2><br>
        <form class="form-inline">
            <div class="container">
                <div class="row">
                    <div class="col">
                    </div>
                    <div class="col">
                        <date-picker v-model="dateRange" v-on:confirm="filer" range appendToBody valueType="format" lang="es" confirm></date-picker>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" v-on:click="getAppointments">Reiniciar tabla</button>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <div class="row justify-content-center">
            <div class="col">
                
                <table class="table text-center table-bordered table-hover table-striped"><!--Creamos una tabla que mostrará todas las tareas-->
                    <thead  class="thead-light">
                        <tr>
                            <th @click="sort()" scope="col">Fecha Consulta <i :class="[currentSortIcon]" ></i></th>
                            <th scope="col">Paciente</th>
                            <th scope="col">Servicio</th>
                            <th scope="col">Medico</th>
                            <th scope="col">Precio Servicio</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="appointment in appointmentsSorted" :key="appointment.id"> <!--Recorremos el array y cargamos nuestra tabla-->
                            <td v-text="appointment.date"></td>
                            <td v-text="appointment.patient_name"></td>
                            <td v-text="appointment.service_name"></td>
                            <td v-text="appointment.dentist_name"></td>
                            <td v-text="appointment.price"></td>
                            <td>
                                <form class="form-inline">
                                   
                                    <!--Botón modificar, que carga los datos del formulario con la tarea seleccionada-->
                                    <button class="btn btn-default" @click="loadFieldsUpdate(task)"><i class="fa fa-pencil"></i></button>
                                    <!--Botón que borra la tarea que seleccionemos-->
                                    <button class="btn btn-default" @click="deleteTask(task)"><i class="fa fa-trash-o fa-lg"> </i></button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h>Pagina actual: {{currentPage}}</h><br>
                <div class="row justify-content-center">
                    <i @click="prevPage()" class="btn fa fa-arrow-left" aria-hidden="true" size="6"></i>
                    &nbsp;&nbsp;&nbsp;
                    <i @click="nextPage()" class="btn fa fa-arrow-right" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import DatePicker from 'vue2-datepicker';

    export default {
        components: { DatePicker },
        data()
        {
            return {
                appointments: [],
                url: 'api/Appointments',
                pagination: [],
                currentSortDir:'asc',
                currentSortIcon:'fa fa-caret-up',
                pageSize:10,
                currentPage:1,
                dateRange: '',
            }
        },
        mounted()
        {
            this.getAppointments();
        },
        methods:
        {
            getAppointments()
            {
                axios.get(this.url).then(response => {
                    this.appointments = response.data
                });
            },
            getFilteredAppointments(initialDate, finalDate)
            {
                axios.get(this.url+'/'+initialDate+'/'+finalDate).then(response => {
                    this.appointments = response.data
                });
            },
            sort:function() 
            {

                if(this.currentSortDir==='asc')
                {
                    this.currentSortDir='desc';
                    this.currentSortIcon = 'fa fa-caret-down'
                }
                else
                {
                    this.currentSortDir='asc';
                    this.currentSortIcon = 'fa fa-caret-up'
                }

            },
            nextPage:function() 
            {
                if((this.currentPage*this.pageSize) < this.appointments.length) 
                {
                    this.currentPage++;
                }
            },
            prevPage:function() {
                if(this.currentPage > 1) 
                {
                    this.currentPage--;
                }
            },
            filer()
            {
                this.getFilteredAppointments(this.dateRange[0],this.dateRange[1]);
            }
            
        },
        computed:
        {
            appointmentsSorted:function() 
            {
                return this.appointments.sort((a,b) => {
                let modifier = 1;
                if(this.currentSortDir === 'desc')
                {
                    modifier = -1;
                } 
                if(a['date'] < b['date']) 
                {
                    return -1 * modifier;
                }
                if(a['date'] > b['date'])
                { 
                    return 1 * modifier;
                }
                return 0;
                }).filter((row, index) => 
                {
                    let start = (this.currentPage-1)*this.pageSize;
                    let end = this.currentPage*this.pageSize;
                    if(index >= start && index < end) 
                        return true;
                });
            }
        }

     
        
    }
</script>
