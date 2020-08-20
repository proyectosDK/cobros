//controller que se encarga de interactuar con la vista y con los servicios axios
model.estadoController = {

    estado: {
        id: ko.observable(null),
        cliente_id: ko.observable(null),
        estado: ko.observable(null),
        fecha: ko.observable("")
    },

   cliente: {
        nombres: ko.observable(""),
        estado: ko.observable(""),
        edad: ko.observable(""),
        fecha_inicio: ko.observable(""),
        cui: ko.observable(""),
        nit: ko.observable(""),
        telefonos: ko.observableArray([]),
        ubicacion: ko.observable("")
    },

    estados: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    estados: [{ nombre: 'Dar de alta', valor: 1 }, { nombre: 'Dar de baja', valor: 2 }, { nombre: 'Suspender', valor: 3 }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.estadoController.estado;
        form.id(data.id);
        form.cliente_id(data.cliente_id);
        form.estado(data.estado);
        form.fecha(data.fecha);
    },

  //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.estadoController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    //limpiar formulario
    clearData: function(){
       let self = model.estadoController;

        Object.keys(self.estado).forEach(function(key,index) {
          if(typeof self.estado[key]() === "string") 
            self.estado[key]("")
          else if (typeof self.estado[key]() === "boolean") 
            self.estado[key](true)
          else if (typeof self.estado[key]() === "number") 
            self.estado[key](null)
        });
    },


   //editar registros del formulario
    editar: function (data){
        let self = model.estadoController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

//crear o editar registro, segun condicion if.
    createOrEdit(){
        let self = model.estadoController;
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.estado.id() === null ? self.create() : self.update()
    },

//crear registro, manda a llamar el create del service
    create: function () {
        let self = model.estadoController;
        var data = self.estado;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        estadoService.create(dataParams)
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
        let self = model.estadoController;
        var data = self.estado;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        estadoService.update(dataParams)
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
        let self= model.estadoController;
        bootbox.confirm({ 
            title: "eliminar estado",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    estadoService.destroy(data)
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
        let self = model.estadoController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },

//funcion para volver al index, resetea variables de bandera
    volverIndex(){
        let self = model.estadoController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    getCliente: function(id){
        var self = model.estadoController;
        //llamada al servicio
        clienteService.get(id)
        .then(r => {
            r.data = JSON.parse(JSON.stringify(r.data).replace(/null/g, '""'))
            self.cliente.nombres(r.data.primer_nombre+' '+r.data.segundo_nombre+' '+r.data.primer_apellido+' '+r.data.segundo_apellido);
            self.cliente.cui(r.data.cui);
            self.cliente.nit(r.data.nit !== null ? r.data.cui : 'C/F');
            self.cliente.edad(moment().diff(r.data.fecha_nac, 'years',false));
            self.cliente.fecha_inicio(moment(r.data.fecha_inicio).format('DD/MM/YYYY'));
            self.cliente.estado(r.data.estado);
            self.cliente.ubicacion(r.data.ubicacion+' '+r.data.ubicacion_cliente.nombre);
            self.cliente.telefonos(r.data.telefonos);

        })
        .catch(r => {});
    },

//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function (id_cliente) {
        var self = model.estadoController;
        self.getCliente(id_cliente);

        //llamada al servicio
        /*estadoService.getAll()
        .then(r => {
            self.estados(r.data);
        })
        .catch(r => {});*/
    }
};