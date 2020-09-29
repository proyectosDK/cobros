//servicios con axios para consumir controladores
mesService = {
//peticion a funcion index 
    getAll() {
        return axios.get(`mess`);
    },
//peticion a funcion get
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },
//peticion a funcion create
    create(data) {
        return axios.post(`mess`, data);
    },
//peticion a funcion update
    update(data) {
        return axios.put(`mess/${data.id}`,data);
    },
//peticion a funcion destroy
    destroy(data){
        return axios.delete(`mess/${data.id}`);
    }

}

