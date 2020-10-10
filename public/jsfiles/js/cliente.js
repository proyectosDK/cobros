//controller que se encarga de interactuar con la vista y con los servicios axios
model.clienteController = {

    cliente: {
        id: ko.observable(null),
        ubicacion_id: ko.observable(null),
        cui: ko.observable(""),
        nit: ko.observable(""),
        primer_nombre: ko.observable(""),
        segundo_nombre: ko.observable(""),
        primer_apellido: ko.observable(""),
        segundo_apellido: ko.observable(""),
        fecha_nac: ko.observable(""),
        genero: ko.observable(""),
        fecha_inicio: ko.observable(""),
        ubicacion: ko.observable(""),
        telefono: ko.observable(""),
        telefonos: ko.observableArray([])
    },

    clientes: ko.observableArray([]),
    ubicaciones: ko.observable([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    generos: [{ nombre: 'Masculino', valor: 'M' }, { nombre: 'Femenino', valor: 'F' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.clienteController.cliente;
        form.id(data.id);
        form.ubicacion_id(data.ubicacion_id);
        $('#ubicaion_id').selectpicker('refresh');
        form.nit(data.nit);
        form.cui(data.cui);
        form.primer_nombre(data.primer_nombre);
        form.segundo_nombre(data.segundo_nombre);
        form.primer_apellido(data.primer_apellido);
        form.segundo_apellido(data.segundo_apellido);
        form.fecha_nac(data.fecha_nac);
        form.fecha_inicio(data.fecha_inicio);
        form.genero(data.genero);
        form.ubicacion(data.ubicacion);
        form.telefonos(data.telefonos);
    },

  //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.clienteController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    //limpiar formulario
    clearData: function(){
       let self = model.clienteController;

        Object.keys(self.cliente).forEach(function(key,index) {
          if(typeof self.cliente[key]() === "string") 
            self.cliente[key]("")
          else if (typeof self.cliente[key]() === "boolean") 
            self.cliente[key](true)
          else if (typeof self.cliente[key]() === "number") 
            self.cliente[key](null)
        });
    },


   //editar registros del formulario
    editar: function (data){
        let self = model.clienteController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

//crear o editar registro, segun condicion if.
    createOrEdit(){
        let self = model.clienteController;

        if(self.cliente.telefonos().length === 0){
            toastr.error("debe ingresar al menos un numero de teléfono","error");
            return
        }
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.cliente.id() === null ? self.create() : self.update()
    },

//crear registro, manda a llamar el create del service
    create: function () {
        let self = model.clienteController;
        var data = self.cliente;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        clienteService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
           $('#nuevo').modal('hide');
            self.volverIndex();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

    //funcion para actualizar registro
     update: function () {
        let self = model.clienteController;
        var data = self.cliente;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        clienteService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            $('#nuevo').modal('hide');
            self.volverIndex();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

//funcion para eliminar registro
    destroy: function (data) {
        let self= model.clienteController;
        bootbox.confirm({ 
            title: "eliminar cliente",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    clienteService.destroy(data)
                    .then(r => {
                        toastr.info("registro eliminado éxito",'éxito');
                        self.volverIndex();
                    })
                    .catch(r => {
                        toastr.error(r.response.data.error)
                    });
                }
            }
        })
    },

//funcion para cancelar registro
    cancelar: function () {
        let self = model.clienteController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },

//funcion para volver al index, resetea variables de bandera
    volverIndex(){
        let self = model.clienteController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    //agregar telefonos
    addTelefono: function(){
        let self = model.clienteController;
        var numero = self.cliente.telefono();
        if(numero == "" || numero == null){
            toastr.error("el teléfono esta vacio","error");
            return;
        }
        self.cliente.telefonos.push({numero: numero});
        self.cliente.telefono("")
    },

    removeTelefono: function(telefono){
        let self = model.clienteController
        var i = self.cliente.telefonos().indexOf(telefono);
        self.cliente.telefonos.splice(i,1);
    },

    //obtener ubicaciones
    getUbicaciones: function(){
        let self = model.clienteController;

        ubicacionService.getAll()
        .then(r=>{
            self.ubicaciones(r.data);
        }).catch(e=>{});
    },



//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.clienteController;

        //llamada al servicio
        clienteService.getAll()
        .then(r => {
            r.data = JSON.parse(JSON.stringify(r.data).replace(/null/g, '""'))
            self.clientes(r.data);
        })
        .catch(r => {});

        self.getUbicaciones();
    }
};