//servicios con axios para consumir controladores
estadoService = {
    //peticion a funcion index
    getAll() {
        return axios.get(`estados`);
    },

    //peticion a funcion show
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },

    //peticion a funcion create
    create(data) {
        return axios.post(`estados`, data);
    },

    //peticion a funcion update
    update(data) {
        return axios.put(`estados/${data.id}`,data);
    },

    //peticion a funcion destroy
    destroy(data){
        return axios.delete(`estados/${data.id}`);
    }

}