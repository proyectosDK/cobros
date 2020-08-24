//controller que se encarga de interactuar con la vista y con los servicios axios
model.serieController = {

    serie: {
        id: ko.observable(null),
        serie: ko.observable(""),
        inicio: ko.observable(""),
        total: ko.observable("")
    },

    series: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ serie: 'Producto', valor: 'P' }, { serie: 'Materia Prima', valor: 'M' }, { serie: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.serieController.serie;
        form.id(data.id);
        form.serie(data.serie);
        form.inicio(data.inicio);
        form.total(data.total);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.serieController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

   //limpiar formulario
    clearData: function(){
       let self = model.serieController;

        Object.keys(self.serie).forEach(function(key,index) {
          if(typeof self.serie[key]() === "string") 
            self.serie[key]("")
          else if (typeof self.serie[key]() === "boolean") 
            self.serie[key](true)
          else if (typeof self.serie[key]() === "number") 
            self.serie[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.serieController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },
//crear o editar registro, segun condicion if.
    createOrEdit(){
        let self = model.serieController;

        if(self.serie.inicio() >= self.serie.total()){
            toastr.error('total de comprobantes debe ser mayor a numero inicio comprobante','error');
            return
        }

     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.serie.id() === null ? self.create() : self.update()
    },
//crear registro, manda a llamar el create del service
    create: function () {
        let self = model.serieController;

        if(self.series().find(x=>x.serie == self.serie.serie())){
            toastr.error('serie ya fue ingresada','error');
            return
        }

         if(self.series().find(x=>x.actual == 1)){
            toastr.error('aun existe serie activa','error');
            return
        }

        var data = self.serie;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        serieService.create(dataParams)
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
        let self = model.serieController;
        var data = self.serie;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        serieService.update(dataParams)
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
        let self= model.serieController;
        bootbox.confirm({ 
            title: "eliminar serie",
            message: "¿Esta seguro que quiere eliminar " + data.serie + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    serieService.destroy(data)
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
        let self = model.serieController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },
//funcion para volver al index, resetea variables de bandera
    volverIndex(){
        let self = model.serieController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

//funcion que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.serieController;

        //llamada al servicio
        serieService.getAll()
        .then(r => {
            self.series(r.data);
        })
        .catch(r => {});
    }
};