//servicios con axios para consumir controladores
cuotaService = {
//peticion a funcion index 
    getAll() {
        return axios.get(`cuotas`);
    },
//peticion a funcion get
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },
//peticion a funcion create
    create(data) {
        return axios.post(`cuotas`, data);
    },
//peticion a funcion update
    update(data) {
        return axios.put(`cuotas/${data.id}`,data);
    },
//peticion a funcion destroy
    destroy(data){
        return axios.delete(`cuotas/${data.id}`);
    },

    //peticion a funcion cambiarEstado
    cambiarEstado(data) {
        return axios.put(`cuotas_cambiar_estado/${data.id}`,data);
    },

}