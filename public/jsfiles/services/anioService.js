//servicios con axios para consumir controladores
anioService = {
//peticion a funcion index 
    getAll() {
        return axios.get(`anios`);
    },
//peticion a funcion get
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },
//peticion a funcion create
    create(data) {
        return axios.post(`anios`, data);
    },
//peticion a funcion update
    update(data) {
        return axios.put(`anios/${data.id}`,data);
    },
//peticion a funcion destroy
    destroy(data){
        return axios.delete(`anios/${data.id}`);
    }

}