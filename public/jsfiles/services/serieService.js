//servicios con axios para consumir controladores
serieService = {
//peticion a funcion index 
    getAll() {
        return axios.get(`series`);
    },
//peticion a funcion get
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },
//peticion a funcion create
    create(data) {
        return axios.post(`series`, data);
    },
//peticion a funcion update
    update(data) {

        return axios.put(`series/${data.id}`,data);
    },
//peticion a funcion destroy
    destroy(data){
        console.log(data)
        return axios.delete(`series/${data.id}`);
    }

}