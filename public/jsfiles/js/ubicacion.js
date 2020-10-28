//controller que se encarga de interactuar con la vista y con los servicios axios
model.ubicacionController = {

    ubicacion: {
        id: ko.observable(null),
        nombre: ko.observable("")
    },

    ubicacions: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.ubicacionController.ubicacion;
        form.id(data.id);
        form.nombre(data.nombre);
    },

  //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.ubicacionController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    //limpiar formulario
    clearData: function(){
       let self = model.ubicacionController;

        Object.keys(self.ubicacion).forEach(function(key,index) {
          if(typeof self.ubicacion[key]() === "string") 
            self.ubicacion[key]("")
          else if (typeof self.ubicacion[key]() === "boolean") 
            self.ubicacion[key](true)
          else if (typeof self.ubicacion[key]() === "number") 
            self.ubicacion[key](null)
        });
    },


   //editar registros del formulario
    editar: function (data){
        let self = model.ubicacionController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

//crear o editar registro, segun condicion if.
    createOrEdit(){
        let self = model.ubicacionController;
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.ubicacion.id() === null ? self.create() : self.update()
    },

//crear registro, manda a llamar el create del service
    create: function () {
        let self = model.ubicacionController;
        var data = self.ubicacion;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        ubicacionService.create(dataParams)
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
        let self = model.ubicacionController;
        var data = self.ubicacion;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        ubicacionService.update(dataParams)
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
        let self= model.ubicacionController;
        bootbox.confirm({ 
            title: "eliminar ubicacion",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    ubicacionService.destroy(data)
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
        let self = model.ubicacionController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },

//funcion para volver al index, resetea variables de bandera
    volverIndex(){
        let self = model.ubicacionController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.ubicacionController;

        //llamada al servicio
        ubicacionService.getAll()
        .then(r => {
            self.ubicacions(r.data);
        })
        .catch(r => {});
    }
};