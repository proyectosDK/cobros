//controller que se encarga de interactuar con la vista y con los servicios axios
model.cobroController = {

    cobro: {
        id: ko.observable(null),
        serie_id: ko.observable(null),
        fecha: ko.observable(""),
        total: ko.observable(0),
        cliente_id: ko.observable(null),
        cuota: ko.observable(null),
        cuota_id: ko.observable(null),
        serie: ko.observable(""),
        numero: ko.observable(""),
        detalle: ko.observableArray([])
    },

    d_cobro:{
        anio_id: ko.observable(null),
        mes_id: ko.observable(null),
        lectura: ko.observable(null),
        detalle: ko.observableArray([]),
        anio: ko.observable(null),
        mes: ko.observable(null),
        total_mes: ko.observable(null),
        agua_extra: ko.observable(0),
        total_extra: ko.observable(0)
    },

    cuota_info: {
        cuota: ko.observable(null),
        limite: ko.observable(null),
        extra: ko.observable(null)
    },

    info: {
        numero: ko.observable(""),
        cliente: ko.observable(""),
        cui: ko.observable(""),
        nit: ko.observable(""),
        direccion: ko.observable(""),
        fecha: ko.observable(""),
        cuota: ko.observable(""),
        total: ko.observable(""),
        anulado: ko.observable(0),
        detalle: ko.observableArray([])
    },


    cobros: ko.observableArray([]),
    meses: ko.observableArray([]),
    meses_activos: ko.observableArray([]),
    clientes: ko.observableArray([]),
    anios: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ cobro: 'Producto', valor: 'P' }, { cobro: 'Materia Prima', valor: 'M' }, { cobro: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.cobroController.cobro;
        form.id(data.id);
        form.serie_id(data.serie_id);
        form.fecha(data.fecha);
        form.total(data.total);
        form.cliente_id(data.cliente_id);
        form.cuota_id(data.cuota_id);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.cobroController;
       self.clearData();
       self.totalAmount();
       self.insertMode(true);
       self.gridMode(false);
       self.editMode(false);        
       self.getCuotas();
       self.getSeries();
    },

   //limpiar formulario
    clearData: function(){
       let self = model.cobroController;

        Object.keys(self.cobro).forEach(function(key,index) {
          if(typeof self.cobro[key]() === "string") 
            self.cobro[key]("")
          else if (typeof self.cobro[key]() === "boolean") 
            self.cobro[key](true)
          else if (typeof self.cobro[key]() === "number") 
            self.cobro[key](null)
        });

        Object.keys(self.d_cobro).forEach(function(key,index) {
          if(typeof self.d_cobro[key]() === "string") 
            self.d_cobro[key]("")
          else if (typeof self.d_cobro[key]() === "boolean") 
            self.d_cobro[key](true)
          else if (typeof self.d_cobro[key]() === "number") 
            self.d_cobro[key](null)
        });

        self.cobro.detalle([])
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.cobroController;
        //self.map(data);
        data = JSON.parse(JSON.stringify(data).replace(/null/g, '""'))
        var cliente = data.cliente.primer_nombre+' '+data.cliente.segundo_nombre+' '+data.cliente.primer_apellido+' '+data.cliente.segundo_apellido;
        var numero = data.serie.serie+' '+data.numbero;
        self.info.cliente(cliente);
        self.info.nit(data.cliente.nit);
        self.info.cui(data.cliente.cui);
        self.info.numero(data.serie.serie+'-'+data.numero);
        self.info.detalle(data.detalle);
        self.info.fecha(data.fecha);
        self.info.cuota(data.cuota.cuota);
        self.info.total(data.total);
        self.info.anulado(data.anulado);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(false);
    },
//crear o editar registro, segun condicion if.
    createOrEdit(){
        let self = model.cobroController;
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.cobro.id() === null ? self.create() : self.update()
    },
//crear registro, manda a llamar el create del service
    create: function () {
        let self = model.cobroController;
        var data = self.cobro;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        cobroService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
           //$('#nuevo').modal('hide');
            self.volverIndex();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },
    //funcion para actualizar
     update: function () {
        let self = model.cobroController;
        var data = self.cobro;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        cobroService.update(dataParams)
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
        let self= model.cobroController;
        bootbox.confirm({ 
            title: "eliminar cobro",
            message: "¿Esta seguro que desea anular cobro " + data.serie.serie+'-'+data.numero + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    cobroService.destroy(data)
                    .then(r => {
                        toastr.info("registro anulado con éxito",'éxito');
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
        let self = model.cobroController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },
//funcion para volver al index, resetea variables de bandera
    volverIndex(){
        let self = model.cobroController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    getMeses: function(){
        let self = model.cobroController;

        mesService.getAll()
        .then(r=>{
            self.meses(r.data);
        }).catch(e=>{

        })
    },

    getAnios: function(){
        let self = model.cobroController;

        anioService.getAll()
        .then(r => {
            self.anios(r.data);
           /* var actual = self.anios().find(a=>a.anio == moment().year())
            if (actual){
                self.d_cobro.anio_id(actual.id)
            }   */
        })
        .catch(r => {});
    },

    getCuotas: function(){
        let self = model.cobroController;

        cuotaService.getAll()
        .then(r=>{
            var cuota = r.data.find(c=>c.actual == 1)
            self.cobro.cuota_id(cuota.id);
            self.cobro.cuota(cuota.cuota);
            self.cuota_info.cuota(parseInt(cuota.cuota));
            self.cuota_info.limite(cuota.limite);
            self.cuota_info.extra(cuota.extra);

        }).catch(e=>{

        })
    },

    getClientes: function(){
        let self = model.cobroController;

        clienteService.getAll()
        .then(r=>{
            r.data = JSON.parse(JSON.stringify(r.data).replace(/null/g, '""'))
            self.clientes(r.data)
        }).catch(e=>{

        })
    },

    getSeries: function(){
        let self = model.cobroController;

        serieService.getAll()
        .then(r=>{
            var serie = r.data.find(c=>c.actual == 1)
            self.cobro.serie_id(serie.id);
            self.cobro.serie(serie.serie);
            self.cobro.numero(serie.no_actual+1);
        }).catch(e=>{

        })
    },

    filterMeses: function(anio,meses){
        let self = model.cobroController;
        var date = moment()
        var month = date.month() 
        var year = date.year()
        var day  = date.date()

        if (year == anio){
            var meses = day >=5 ? meses.filter(x=>x.id <= month) : meses.filter(x=>x.id < month)
        }

        var cobros = self.cobros().filter(c=>c.cliente_id == self.cobro.cliente_id())
        var meses_cobros = []

        cobros.forEach((c,i)=>{
            c.detalle.forEach((d,j)=>{
                if(d.anio_id == self.d_cobro.anio_id()){
                    meses_cobros.push(d.mes_id)
                }
            })
            //meses_cobros = [...meses_cobros, ...c.detalle];
        })

        console.log(meses_cobros)
        meses = meses.filter(f => !meses_cobros.includes(f.id));

        self.meses_activos(meses)

    },

    addDetalle: function(){
        let self = model.cobroController;

        //validar formulario
        if (!model.validateForm('#formulario')) {
            return;
        }

        //validar formulario
        if (!model.validateForm('#form2')) {
            return;
        }

        var mes = self.meses().find(p => p.id == self.d_cobro.mes_id());
        var anio = self.anios().find(a=>a.id == self.d_cobro.anio_id());

        if (self.cobro.detalle().some(f => f.mes_id == mes.id && f.anio_id == anio.id)) {
            toastr.error("mes del año ya fue agregado", "error");
            return;
        }

        var total_extra = 0;
        var agua_extra = 0;

        if(self.d_cobro.lectura() > self.cuota_info.limite()){
            agua_extra = self.d_cobro.lectura() - self.cuota_info.limite()
            total_extra = agua_extra * self.cuota_info.extra()
        }

        var total_mes = self.cuota_info.cuota() + total_extra

        self.cobro.detalle.push({
            anio: anio.anio,
            anio_id: self.d_cobro.anio_id(),
            mes_id: self.d_cobro.mes_id(),
            lectura: self.d_cobro.lectura(),
            mes: mes.mes,
            total_mes: total_mes,
            total_extra: total_extra,
            agua_extra: agua_extra
        });

        self.totalAmount()
    },

    //remover producto de detalle
    removeDetail: function (d) {
        let self = model.cobroController;

        var i = self.cobro.detalle().indexOf(d);
        self.cobro.detalle.splice(i, 1);
        self.totalAmount();
    },

    //calcular total
    totalAmount: function () {
        let self = model.cobroController;

        const sumItems = (mesAmount, nextItem) => mesAmount + (nextItem.total_mes);

        self.cobro.total(self.cobro.detalle().reduce(sumItems, 0));
    },

//funcion que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.cobroController;

        //llamada al servicio
        cobroService.getAll()
        .then(r => {
            self.cobros(r.data);
        })
        .catch(r => {});

        self.getAnios();
        self.getMeses();
        self.getClientes();
        self.getCuotas();
    }
};

model.cobroController.d_cobro.anio_id.subscribe(function (value) {
    if (value !== undefined && value !== null) {
        if (!model.validateForm('#formulario')) {
            model.cobroController.d_cobro.anio_id(null)
            return;
        }
        var anio = model.cobroController.anios().find(a => a.id == value)

        model.cobroController.filterMeses(anio.anio,model.cobroController.meses())
    }
})

model.cobroController.cobro.cliente_id.subscribe(function (value) {
    if (value !== undefined && value !== null) {
        if(model.cobroController.d_cobro.anio_id() !== null && model.cobroController.d_cobro.anio_id() !== undefined){
            var anio = model.cobroController.anios().find(a => a.id == model.cobroController.d_cobro.anio_id())
            model.cobroController.filterMeses(anio.anio,model.cobroController.meses()) 
        }
        
    }
})