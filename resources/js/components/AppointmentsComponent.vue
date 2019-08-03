<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Lista de tareas</h2>
                <table class="table text-center table-bordered table-hover table-striped"><!--Creamos una tabla que mostrará todas las tareas-->
                    <thead  class="thead-light">
                        <tr>
                            <th scope="col">Fecha Consulta</th>
                            <th scope="col">Paciente</th>
                            <th scope="col">Servicio</th>
                            <th scope="col">Medico</th>
                            <th scope="col">Precio Servicio</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="appointment in appointments.data.data" :key="appointment.id"> <!--Recorremos el array y cargamos nuestra tabla-->
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
            </div>
        </div>
    </div>

</template>

<script>
    export default {

        data()
        {
            return {
                appointments: []
            }
        },
        mounted()
        {
            var url = 'api/Appointments';
            axios.get(url).then(response => {
                this.appointments = response
            });
        }
     
        
    }
</script>
