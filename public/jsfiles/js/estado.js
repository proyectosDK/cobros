//controller que se encarga de interactuar con la vista y con los servicios axios
model.estadoController = {

    estado: {
        id: ko.observable(null),
        cliente_id: ko.observable(null),
        estado: ko.observable(null),
        fecha: ko.observable(""),
        observaciones: ko.observable("")
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
    cobros:ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    estadosAction: [{ nombre: 'Dar de alta', valor: 1 }, { nombre: 'Dar de baja', valor: 2 }, { nombre: 'Suspender', valor: 3 }],


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
            self.volverIndex(dataParams.cliente_id);  
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
            self.volverIndex(dataParams.cliente_id);
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

//funcion para eliminar registro
    destroy: function (data) {
        let self= model.estadoController;
        bootbox.confirm({ 
            title: "remover acción",
            message: "¿Esta seguro que quiere remover acción?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    estadoService.destroy(data)
                    .then(r => {
                        toastr.info("registro eliminado éxito",'éxito');
                        self.volverIndex(data.cliente_id);
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
    volverIndex(id){
        let self = model.estadoController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize(id)
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

            self.setEstados(r.data.estados);
            self.cobros(r.data.cobros);

        })
        .catch(r => {});
    },

    setEstados: function(estados){
        estados = estados.sort(function(a,b){
          return new Date(b.fecha) - new Date(a.fecha)
        })
        let self = model.estadoController;
        var estados_t = []
        estados.forEach((e,i)=>{
            estados_t.push({
                id: e.id,
                cliente_id: e.cliente_id,
                estado: e.estado,
                estado_name: e.estado == 1 ? 'Se dio de alta' : e.estado==2 ? 'Se dio de baja' : 'Suspendido',
                fecha: moment(e.fecha).format('DD/MM/YYYY'),
                observacion: e.observaciones,
                class: e.estado == 1? 'bg-green':'bg-red',
                icon: e.estado == 1?'fa fa-check bg-green':'fa fa-thumbs-down bg-red',
                delete: i==0 ? true : false
            })

        });
        self.estados(estados_t)
    },

//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function (id_cliente) {
        var self = model.estadoController;
        self.getCliente(id_cliente);
        self.estado.cliente_id(id_cliente);

        //llamada al servicio
        /*estadoService.getAll()
        .then(r => {
            self.estados(r.data);
        })
        .catch(r => {});*/
    }
};