//controller que se encarga de interactuar con la vista y con los servicios axios
model.anioController = {

    anio: {
        id: ko.observable(null),
        anio: ko.observable("")
    },

    anios: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ anio: 'Producto', valor: 'P' }, { anio: 'Materia Prima', valor: 'M' }, { anio: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.anioController.anio;
        form.id(data.id);
        form.anio(data.anio);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.anioController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },
   //limpiar formulario
    clearData: function(){
       let self = model.anioController;

        Object.keys(self.anio).forEach(function(key,index) {
          if(typeof self.anio[key]() === "string") 
            self.anio[key]("")
          else if (typeof self.anio[key]() === "boolean") 
            self.anio[key](true)
          else if (typeof self.anio[key]() === "number") 
            self.anio[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.anioController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },
//crear o editar registro, segun condicion if.
    createOrEdit(){
        let self = model.anioController;
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.anio.id() === null ? self.create() : self.update()
    },
//crear registro, manda a llamar el create del service
    create: function () {
        let self = model.anioController;
        var data = self.anio;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        anioService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
           $('#nuevo').modal('hide');
            self.volverIndex();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },
    //funcion para actualizar
     update: function () {
        let self = model.anioController;
        var data = self.anio;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        anioService.update(dataParams)
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
        let self= model.anioController;
        bootbox.confirm({ 
            title: "eliminar anio",
            message: "¿Esta seguro que quiere eliminar " + data.anio + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    anioService.destroy(data)
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
        let self = model.anioController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },
//funcion para volver al index, resetea variables de bandera
    volverIndex(){
        let self = model.anioController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },
//funcion que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.anioController;

        //llamada al servicio
        anioService.getAll()
        .then(r => {
            self.anios(r.data);
        })
        .catch(r => {});
    }
};