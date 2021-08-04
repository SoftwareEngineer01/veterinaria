<template>
    <div>
        <!-- Modal para Agregar Paciente -->
        <b-modal id="modal-1" ref="pacienteModal" hide-footer title="Agregar Paciente" scrollable>
            <div class="d-block">                
                <form v-on:submit.prevent="agregarPaciente">
                    <div class="form-row">

                        <!-- Nombre de la Mascota -->
                        <div class="form-group col-md-6">
                            <label for="nombre_mascota">Nombre de la mascota</label>
                            <input type="text" v-model="nombre_mascota" class="form-control" id="nombre_mascota" placeholder="Nombre de la Mascota">                           
                        </div>

                        <!-- Tipo Mascota -->
                        <div class="form-group col-md-6">
                            <label for="tipo_mascota">Tipo de mascota</label>
                            <input type="text" v-model="tipo_mascota" class="form-control" id="tipo_mascota" placeholder="Tipo de Mascota">                           
                        </div>

                    </div>

                    <div class="form-row">
                        
                        <!-- Raza de la Mascota -->
                        <div class="form-group col-md-6">
                            <label for="raza_mascota">Raza de la mascota</label>
                            <input type="text" v-model="raza_mascota" class="form-control" id="raza_mascota" placeholder="Raza de la Mascota">                           
                        </div>

                        <!-- Nacimiento Mascota -->
                        <div class="form-group col-md-6">
                            <label for="nacimiento_mascota">Nacimiento Mascota</label>
                            <input type="date" v-model="nacimiento_mascota" class="form-control" id="nacimiento_mascota">                           
                        </div>

                    </div>

                    <div class="form-row">

                        <!-- Nombre del Propietario -->
                        <div class="form-group col-md-6">
                            <label for="nombre_propietario">Nombre del Propietario</label>
                            <input type="text" v-model="nombre_propietario" class="form-control" id="nombre_propietario" placeholder="Nombre del Propietario">                           
                        </div>

                        <!-- Apellido del Propietario -->
                        <div class="form-group col-md-6">
                            <label for="apellido_propietario">Apellido del Propietario</label>
                            <input type="text" v-model="apellido_propietario" class="form-control" id="apellido_propietario" placeholder="Apellido del Propietario">                            
                        </div>
                         
                    </div>

                    <div class="form-row">

                        <!-- Teléfono -->
                        <div class="form-group col-md-4">
                            <label for="telefono">Teléfono</label>
                            <input type="text" v-model="telefono" class="form-control" id="telefono" placeholder="Teléfono">                           
                        </div>

                        <!-- Dirección -->
                        <div class="form-group col-md-4">
                            <label for="direccion">Dirección</label>
                            <input type="text" v-model="direccion" class="form-control" id="direccion" placeholder="Direccion">                           
                        </div>

                         <!-- Email -->
                        <div class="form-group col-md-4">
                            <label for="email">Email</label>
                            <input type="email" v-model="email" class="form-control" id="email" placeholder="Email">                           
                        </div>
                         
                    </div>

                    <hr>

                    <div class="text-right">
                        <button type="button" class="btn btn-danger" v-on:click="hidePacienteModal">Cancelar</button>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Guardar</button>
                    </div>
                </form>
            </div>
        </b-modal>
    </div>
</template>

<script>
   
    export default {

        name: 'AgregarPaciente',

        data() {

            return {
               nombre_mascota : "",
               tipo_mascota : "",
               raza_mascota : "",
               nacimiento_mascota : "",
               nombre_propietario : "",
               apellido_propietario : "",
               telefono : "",
               direccion : "",
               email : "",
            }
        },

        mounted() {
           
        },

        methods: {
                       
            agregarPaciente() {
               
                let formData = new FormData();

                formData.append('nombre_mascota', this.nombre_mascota);
                formData.append('tipo_mascota', this.tipo_mascota);
                formData.append('raza_mascota', this.raza_mascota);
                formData.append('nacimiento_mascota', this.nacimiento_mascota);
                formData.append('nombre_propietario', this.nombre_propietario);
                formData.append('apellido_propietario', this.apellido_propietario);
                formData.append('telefono', this.telefono);
                formData.append('direccion', this.direccion);
                formData.append('email', this.email);

                 axios.post("http://localhost:8100/api/pacientes", formData)
                    .then(response => {
                        console.log(response.data);
                        this.$emit("reload");
                        this.hidePacienteModal();
                    }).catch(error => {                        
                        console.error("Ha ocurrido un error!", error);
                    });                
            },

            hidePacienteModal() {                
                this.$refs.pacienteModal.hide();
                this.cleanForm();                
            },
            

            cleanForm() {
                this.nombre_mascota = '';
                this.tipo_mascota = '';
                this.raza_mascota = '';
                this.nacimiento_mascota = '';
                this.nombre_propietario = '';
                this.apellido_propietario = '';
                this.telefono = '';
                this.direccion = '';
                this.email = '';
            },

            // makeToast(title, text, type) {
            //     this.toastCount++
            //     this.$bvToast.toast(text, {
            //         title: title,
            //         variant: type,
            //         autoHideDelay: 3000,
            //         appendToast: true
            //     })
            // },
        }
    }

</script>

<style>
    .errors {
        color: red;
        font-size: 14px;
    }
</style>
