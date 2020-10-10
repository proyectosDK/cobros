//servicios con axios para consumir controladores
ubicacionService = {
    //peticion a funcion index
    getAll() {
        return axios.get(`ubicacions`);
    },

    //peticion a funcion show
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },

    //peticion a funcion create
    create(data) {
        return axios.post(`ubicacions`, data);
    },

    //peticion a funcion update
    update(data) {
        return axios.put(`ubicacions/${data.id}`,data);
    },

    //peticion a funcion destroy
    destroy(data){
        return axios.delete(`ubicacions/${data.id}`);
    }

}