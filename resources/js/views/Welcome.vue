<template>
    <div class="container my-5">

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-auto mr-auto">
                        <h2 class="text-secondary">Lista de Pacientes Veterinaria</h2>
                    </div>
                    <div class="col-auto">
                        <button class="right btn btn-primary" v-b-modal.modal-1 @click="showModal = true">Agregar Paciente</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre Mascota</th>
                                <th>tipop Mascota</th>
                                <th>Raza Mascota</th>
                                <th>Nacimiento Mascota</th>
                                <th>Nombre Propietario</th>
                                <th>Apellido Propietario</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Email</th>
                                <th scope="col-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(paciente, index) in pacientes" :key="index">
                                <td>{{paciente.nombre_mascota}}</td>
                                <td>{{paciente.tipo_mascota}}</td>
                                <td>{{paciente.raza_mascota}}</td>
                                <td>{{paciente.nacimiento_mascota}}</td>
                                <td>{{paciente.nombre_propietario}}</td>
                                <td>{{paciente.apellido_propietario}}</td>
                                <td>{{paciente.telefono}}</td>
                                <td>{{paciente.direccion}}</td>
                                <td>{{paciente.email}}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm"
                                        v-on:click="editPaciente(paciente)">
                                        Editar
                                    </button>
                                    <button class="btn btn-danger btn-sm"
                                        v-on:click="deletePaciente(paciente)">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        </tbody>        
                    </table>   
                </div>
            </div>
            
        </div>

        <!-- Modal para agregar Pacientes -->
        <AgregarPaciente ref="pacienteModal" @reload="reload"></AgregarPaciente >


      
               
        <!-- Modal para Editar Paciente -->
        <b-modal id="editModal" ref="editPacienteModal" hide-footer title="Editar Paciente" scrollable>
            <div class="d-block">                
                <form v-on:submit.prevent="updatePaciente">
                    <div class="form-row">

                        <!-- Nombre de la Mascota -->
                        <div class="form-group col-md-6">
                            <label for="nombre_mascota">Nombre de la mascota</label>
                            <input type="text" v-model="editPacienteData.nombre_mascota" class="form-control" id="editNombre_mascota">                           
                        </div>

                        <!-- Tipo Mascota -->
                        <div class="form-group col-md-6">
                            <label for="tipo_mascota">Tipo de mascota</label>
                            <input type="text" v-model="editPacienteData.tipo_mascota" class="form-control" id="editTipo_mascota">                           
                        </div>

                    </div>

                    <div class="form-row">
                        
                        <!-- Raza de la Mascota -->
                        <div class="form-group col-md-6">
                            <label for="raza_mascota">Raza de la mascota</label>
                            <input type="text" v-model="editPacienteData.raza_mascota" class="form-control" id="editRaza_mascota">                           
                        </div>

                        <!-- Nacimiento Mascota -->
                        <div class="form-group col-md-6">
                            <label for="nacimiento_mascota">Nacimiento Mascota</label>
                            <input type="date" v-model="editPacienteData.nacimiento_mascota" class="form-control" id="editNacimiento_mascota">                           
                        </div>

                    </div>

                    <div class="form-row">

                        <!-- Nombre del Propietario -->
                        <div class="form-group col-md-6">
                            <label for="nombre_propietario">Nombre del Propietario</label>
                            <input type="text" v-model="editPacienteData.nombre_propietario" class="form-control" id="editNombre_propietario">                           
                        </div>

                        <!-- Apellido del Propietario -->
                        <div class="form-group col-md-6">
                            <label for="apellido_propietario">Apellido del Propietario</label>
                            <input type="text" v-model="editPacienteData.apellido_propietario" class="form-control" id="editApellido_propietario">                            
                        </div>
                         
                    </div>

                    <div class="form-row">

                        <!-- Teléfono -->
                        <div class="form-group col-md-4">
                            <label for="telefono">Teléfono</label>
                            <input type="text" v-model="editPacienteData.telefono" class="form-control" id="editTelefono">                           
                        </div>

                        <!-- Dirección -->
                        <div class="form-group col-md-4">
                            <label for="direccion">Dirección</label>
                            <input type="text" v-model="editPacienteData.direccion" class="form-control" id="editDireccion">                           
                        </div>

                         <!-- Email -->
                        <div class="form-group col-md-4">
                            <label for="email">Email</label>
                            <input type="email" v-model="editPacienteData.email" class="form-control" id="editEmail">                           
                        </div>
                         
                    </div>

                    <hr>

                    <div class="text-right">
                        <button type="button" class="btn btn-danger" v-on:click="hidePacienteModal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" ><span class="fa fa-check"></span> Guardar</button>
                    </div>
                </form>
            </div>
        </b-modal>

        
    </div>
</template>

<script>

// Components
import AgregarPaciente  from '../components/AgregarPaciente.vue';

// JQuery
import $ from "jquery";

//Axios
import axios from 'axios';
export default {

    data() {
        return {
            pacientes: [],
            editPacienteData : {}
        }
    },

    mounted() {
        this.loadDataTable();
    },

    components: {
        AgregarPaciente
    },

    methods: {
        
        loadDataTable() {
               axios.get('http://localhost:8100/api/pacientes')
                .then(response => { 

                    this.pacientes = response.data.data;
                    console.log(this.pacientes);
                    $('#example').DataTable();                  

                }).catch(error => {
                    log.error(error);
                });
        },

        editPaciente(paciente) {
            this.editPacienteData = paciente;
            this.$refs.editPacienteModal.show();
        },

        updatePaciente() {
            axios
                .put("http://localhost:8100/api/pacientes/"+this.editPacienteData.id,  this.editPacienteData)
                .then(res => {                    
                    console.log(res.data);
                   
                this.hidePacienteModal();
                }).catch(error => {                        
                    console.error("Ha ocurrido un error!", error);
                }); 
        },


        deletePaciente(paciente) {
            if (!window.confirm(`Esta seguro de eliminar ${paciente.nombre_mascota}`)) {
                return;
            }

            axios
                .delete("http://localhost:8100/api/pacientes/"+paciente.id)
                .then(res => {                    
                    console.log(res.data);                   
                    this.loadDataTable();
                }).catch(error => {                        
                    console.error("Ha ocurrido un error!", error);
                }); 
        },

        hidePacienteModal() {                
            this.$refs.editPacienteModal.hide();                                
        },            

        reload() {
            $('#example').DataTable().destroy();
            this.loadDataTable();
        }
    }
}
</script>
