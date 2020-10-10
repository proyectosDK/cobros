//servicios con axios para consumir controladores
cobroService = {
//peticion a funcion index 
    getAll() {
        return axios.get(`cobros`);
    },
//peticion a funcion get
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },
//peticion a funcion create
    create(data) {
        return axios.post(`cobros`, data);
    },
//peticion a funcion update
    update(data) {
        return axios.put(`cobros/${data.id}`,data);
    },
//peticion a funcion destroy
    destroy(data){
        return axios.delete(`cobros/${data.id}`);
    }

}

