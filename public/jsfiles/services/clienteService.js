//servicios con axios para consumir controladores
clienteService = {
    //peticion a funcion index
    getAll() {
        return axios.get(`clientes`);
    },

    //peticion a funcion show
    get(id) {
        return self.axios.get(`clientes/${id}`);
    },

    //peticion a funcion create
    create(data) {
        return axios.post(`clientes`, data);
    },

    //peticion a funcion update
    update(data) {
        return axios.put(`clientes/${data.id}`,data);
    },

    //peticion a funcion destroy
    destroy(data){
        return axios.delete(`clientes/${data.id}`);
    }

}