
async function carregarFeriados() {
    try {
        const response = await fetch(`https://brasilapi.com.br/api/feriados/v1/${new Date().getFullYear()}`);
        const feriados = await response.json();

        const calendarBody = document.getElementById("calendar-body");
        calendarBody.innerHTML = ""; // Limpa o conteúdo da tabela

        if (feriados.length === 0) {
            // Mensagem caso não existam feriados
            calendarBody.innerHTML = `
                <tr>
                    <td colspan="2" class="text-center text-muted">
                        <i class="fa-regular fa-calendar-xmark fa-lg"></i>
                        Nenhum feriado ou interrupção programada.
                    </td>
                </tr>
            `;
            return;
        }

        feriados.forEach(feriado => {
            // Reformata a data
            const dataOriginal = feriado.date;
            const [ano, mes, dia] = dataOriginal.split("-");
            const dataFormatada = `${dia}/${mes}/${ano}`; // Correção da formatação

            // Monta a descrição com destaque
            const descricao = `
                <strong>${feriado.name}</strong>
                <p class="text-danger mb-0">
                    <i class="fa-solid fa-bus"></i> Não haverá ônibus neste dia.
                </p>
            `;

            // Adiciona à tabela
            calendarBody.innerHTML += `
                <tr>
                    <td class="align-middle">${dataFormatada}</td>
                    <td class="align-middle">${descricao}</td>
                </tr>
            `;
        });
    } catch (error) {
        console.error("Erro ao carregar feriados:", error);
        document.getElementById("calendar-body").innerHTML = `
            <tr>
                <td colspan="2" class="text-center text-muted">
                    <i class="fa-solid fa-exclamation-triangle text-warning"></i>
                    Erro ao carregar os dados. Tente novamente mais tarde.
                </td>
            </tr>
        `;
    }
}

// Carrega os feriados ao iniciar
carregarFeriados();