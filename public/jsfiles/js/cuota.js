//controller que se encarga de interactuar con la vista y con los servicios axios
model.cuotaController = {

    cuota: {
        id: ko.observable(null),
        cuota: ko.observable(""),
        extra: ko.observable(""),
        limite: ko.observable(""),
        actual: ko.observable(true)
    },

    cuotas: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ cuota: 'Producto', valor: 'P' }, { cuota: 'Materia Prima', valor: 'M' }, { cuota: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.cuotaController.cuota;
        form.id(data.id);
        form.cuota(data.cuota);
        form.limite(data.limite);
        form.extra(data.extra);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.cuotaController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },
   //limpiar formulario
    clearData: function(){
       let self = model.cuotaController;

        Object.keys(self.cuota).forEach(function(key,index) {
          if(typeof self.cuota[key]() === "string") 
            self.cuota[key]("")
          else if (typeof self.cuota[key]() === "boolean") 
            self.cuota[key](true)
          else if (typeof self.cuota[key]() === "number") 
            self.cuota[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.cuotaController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },
//crear o editar registro, segun condicion if.
    createOrEdit(){
        let self = model.cuotaController;
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.cuota.id() === null ? self.create() : self.update()
    },
//crear registro, manda a llamar el create del service
    create: function () {
        let self = model.cuotaController;
        var data = self.cuota;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        cuotaService.create(dataParams)
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
        let self = model.cuotaController;
        var data = self.cuota;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        cuotaService.update(dataParams)
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
        let self= model.cuotaController;
        bootbox.confirm({ 
            title: "eliminar cuota",
            message: "¿Esta seguro que quiere eliminar " + data.cuota + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    cuotaService.destroy(data)
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
        let self = model.cuotaController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },
//funcion para volver al index, resetea variables de bandera
    volverIndex(){
        let self = model.cuotaController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

      //funcion para eliminar registro
    cambiarEstado: function (data) {
        let self= model.cuotaController;
        data.actual = 1;

        bootbox.confirm({ 
            title: "activar cuota",
            message: "¿Esta seguro que quiere activar cuota?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    cuotaService.cambiarEstado(data)
                    .then(r => {
                        toastr.info("cuota activada con éxito",'éxito');
                        self.volverIndex();
                    })
                    .catch(r => {
                        toastr.error(r.response.data.error)
                    });
                }
            }
        })
    },
//funcion que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.cuotaController;

        //llamada al servicio
        cuotaService.getAll()
        .then(r => {
            self.cuotas(r.data);
        })
        .catch(r => {});
    }
};