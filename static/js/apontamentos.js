// para funcionar com o /develop, temos que alterar o path
const CURRENT_PATH = window.location.pathname.split("/").slice(0, -1).join("/");
// nossa cache interna
const ALL_DISCIPLINAS_STORE = {};
const DISCIPLINA_STORE = {}

// Variáveis globais
var ano_escolhido, semestre_escolhido, disciplina_escolhida;
var ano_title, semestre_title;

// #region Pedidos AJAX
/**
 * Devolve os apontamentos para uma dada disciplina.
 * Internamente, guarda em cache (ou seja, só vemos os resultados atualizados se refrescarmos a página)
 * @param {Number} disciplina_id id da disciplina
 * @author Miguel Fradinho Alves
 */
function getApontamentos(disciplina_id, callback) {
    // vemos se a disciplina escolhida existe na cache
    // se não existir, então devolvemos uma lista vazia
    // Nota: em teoria, pela workflow, nunca deve cair neste caso
    if (typeof DISCIPLINA_STORE[disciplina_escolhida] === "undefined") {
        callback([]);
        return;
    }
    // no caso de a disciplina existir e já termos ido buscar os apontamentos
    else if (typeof DISCIPLINA_STORE[disciplina_escolhida]["apontamentos"] !== "undefined") {
        // então devolvemos os apontamentos
        callback(DISCIPLINA_STORE[disciplina_escolhida]["apontamentos"]);
        return;
    }
    // se ainda não existir, temos que ir buscar;
    else {
        $.get(
            CURRENT_PATH + "/disciplinas.php",
            params = {
                "disciplina_id": disciplina_id,
            },
            (res) => {
                let vals = res["data"];
                // inserimos na cache
                DISCIPLINA_STORE[disciplina_escolhida]["apontamentos"] = vals;
                // e chamamos a função
                callback(vals);
            }
        );
    }
}

/**
 * Devolve as disciplinas para um dado ano e semestre
 * Internamente, guarda em cache (ou seja, só vemos os resultados atualizados se refrescarmos a página)
 * @param {Number} ano ano do curso
 * @param {Number} semestre semestre das disciplinas
 * @author Miguel Fradinho Alves
 */
function getDisciplinas(ano, semestre, callback) {
    // para evitarmos o type error e termos que escrever o código 2 vezes, fazemos uma verificação simples
    // se ainda não tiver sido pedido o ano, inicializamos com um objeto vazio
    if (typeof ALL_DISCIPLINAS_STORE[ano] === "undefined") {
        ALL_DISCIPLINAS_STORE[ano] = {};
    }
    // assim, quando fazemos a verificação, podemos passar diretamente para o semestre
    // e só escrever o código de pedir ao servidor 1 vez

    // verificamos se já introduzimos o semestre
    if (typeof ALL_DISCIPLINAS_STORE[ano_escolhido][semestre_escolhido] !== "undefined") {
        callback(ALL_DISCIPLINAS_STORE[ano_escolhido][semestre_escolhido]);
    }
    // se não existir, fazemos o pedido, e guardamos na cache
    else {
        $.get(
            CURRENT_PATH + "/disciplinas.php",
            params = {
                "ano": ano,
                "semestre": semestre,
            },
            (resp) => {
                let vals = resp["data"];
                // atualizamos a cache
                ALL_DISCIPLINAS_STORE[ano_escolhido][semestre_escolhido] = vals;
                // atualizamos a cache das disciplinas
                vals.forEach(disp => {
                    // Inserimos no disciplina store
                    DISCIPLINA_STORE[disp["id"]] = disp;
                });
                // e chamamamos a função
                callback(ALL_DISCIPLINAS_STORE[ano_escolhido][semestre_escolhido]);
            }
        );
    }
}
//#endregion

// #region Criação de elementos

// Nota: Se mais tarde forem feitas funções para a criação de elementos, colocar-las aqui
/**
 *  
 * 
 * Retorna um elemento utilizado com cabeçalho nas diferentes secções dos apontamentos.
 * Se o tamanho não for especificado, cria um elemento h2
 * @param {string} headerText Texto do cabeçalho
 * @param {number} size Tamanho do elemento (h1, h2, etc)
 * @author Miguel Fradinho Alves
 */
function createApontHeader(headerText, size = 2) {
    // para evitarmos passagem incorreta
    if (size < 1 || size > 6) {
        size = 2;
    }
    const elem = document.createElement("h" + size);
    const elem_classes = ["apont-header", "col-12", "u-break-word"];
    for (let i = 0; i < elem_classes.length; i++) {
        elem.classList.add(elem_classes[i]);
    }
    // verificamos se foi chamado com texto (tecnicamente, nunca deve acontecer, 
    // mas just in case no caso de passagem de variáveis)
    if (typeof headerText !== "undefined") {
        elem.innerHTML = headerText;
    }

    return elem;
}
/**
 * Retorna um div, com classes caso sejam passadas como argumento
 * @param {Array<string>} classes lista das classes a adicionar ao container, opcional
 * @author Miguel Fradinho Alves
 */
function createContainer(classes = undefined) {
    const elem = document.createElement("div");
    // se não for passado
    if (typeof classes !== 'undefined') {
        // se apenas for um
        if (typeof classes === 'string') {
            elem.classList.add(classes);
        }
        // se for um array
        if (Array.isArray(classes)) {
            elem.classList = classes
        }
    }
    return elem;
}
/**
 * Retorna um elemento correspondente a um item da lista, representando uma disciplina
 * @author Miguel Fradinho Alves
 */
function createDisclipinaListItem(disciplinaObj) {
    const elem = document.createElement("a");
    const elem_classes = ["list-group-item", "list-group-item-action", "uc"];
    for (let i = 0; i < elem_classes.length; i++) {
        elem.classList.add(elem_classes[i]);
    }
    elem.dataset.type = "disciplina";
    elem.dataset.value = disciplinaObj["id"];
    elem.innerText = disciplinaObj["nome"];
    elem.addEventListener("click", click_handler);
    return elem;
}
//#endregion


/**
 * Código utilizado para gerar todas as disciplinas, anos, semestres 
 * de modo a que possa ser feito display das mesmas no código html.
 * 
 * @author José Gonçalves e Rafael Teixeira
 */
function click_handler(event) {

    if (event === undefined) {
        return;
    }
    let target = event.target;

    switch (target.dataset.type) {
        case "ano":
            showSemestres(target.dataset.value);
            break;
        case "semestre":
            gotoDisciplinas(ano_escolhido, target.dataset.value);
            break;
        case "semestreback":
            showAnos();
            break;
        case "disciplinasback":
            showSemestres(ano_escolhido);
            break;
        case "disciplina":
            showApontamentos(target.dataset.value);
            break;
        case "disciplinaback":
            gotoDisciplinas(ano_escolhido, semestre_escolhido);
            break;
        default:
            break;
    }
};

/**
 * Inicializa os listeners iniciais
 * @author Miguel Fradinho Alves
 */
function setupListeners() {
    //Adicionar o handler aos botoes e aos filhos
    // (porque bubble-up e bubble-down)
    $(".apont-button").click(click_handler);
    //$(".apont-button").children().click(click_handler);
}

// #region Lógica de display
/**
 * 
 * @param {Number} ano ano para mostrar os semestres
 */
function showSemestres(ano) {
    if (ano !== ano_escolhido) {
        ano_escolhido = ano;
        ano_title = ano + "º Ano";
        $("#semestres_title").text(ano_title);
    }
    $("#displayer").addClass("hide");
    $("#anos").addClass("hide");
    $("#semestres").removeClass("hide");

}

function showAnos() {
    $("#semestres").addClass("hide");
    $("#anos").removeClass("hide");
}

/**
 * Mostra as disciplinas para um dado semestre/ano
 * @param {Number} ano ano da disciplina
 * @param {Number} semestre semestre da disciplina
 * @author Miguel Fradinho Alves
 */
function gotoDisciplinas(ano, semestre) {
    if (semestre !== semestre_escolhido) {
        semestre_escolhido = semestre;
        semestre_title = semestre + "º Semestre";
    }

    var displayer = document.getElementById("displayer");
    clearElement(displayer);
    $("#semestres").addClass("hide");

    // o título
    let disciplinas_title = createApontHeader(ano_title + "<br>" + semestre_title);
    displayer.appendChild(disciplinas_title);

    let disciplinas_container = createContainer("list-group");

    getDisciplinas(ano, semestre, (disciplinas) => {
        disciplinas.forEach(disciplina => {
            // criamos o elemento
            let disciplina_item = createDisclipinaListItem(disciplina);
            // e fazemos append ao container
            disciplinas_container.appendChild(disciplina_item);
        });
        // caso não existam nenhumas disciplinas
        if (disciplinas.length === 0) {
            disciplinas_container = createApontHeader("De momento não existem nenhumas disciplinas disponíveis", 4);
        }
        // o conteúdo
        displayer.appendChild(disciplinas_container);
        // O botão de retroceder
        var disciplinas_back = document.getElementById("disciplinas").children[0].cloneNode(true);
        // adicionamos o event handler
        disciplinas_back.addEventListener("click", click_handler);
        // e adicionamos ao displayer
        displayer.appendChild(disciplinas_back);
        $("#displayer").removeClass("hide");
    });
}
/**
 * Mostra os apontamentos para uma dada disciplina
 * @param {Number} disciplina_id id da disciplina
 * @author Miguel Fradinho Alves
 */
function showApontamentos(disciplina_id) {
    if (disciplina_id !== disciplina_escolhida) {
        disciplina_escolhida = disciplina_id;
    }



    // meme ITW, by DTeixeira
    if (disciplina_id === 40380) {
        new Date(2018, 09, 24, 09, 14);
        let hour = new Date().getHours();
        let min = new Date().getMinutes();
        if (hour == 9 && min == 14) {
            $('#memeITW').modal('show');
        };
    }

    let displayer = document.getElementById("displayer");
    clearElement(displayer);

    let recursosContainer = document.getElementById("recursos").getElementsByClassName("table")[0].cloneNode(true);
    let tablebody = recursosContainer.children[1];
    let table_row_prototype = tablebody.removeChild(tablebody.children[0]);
    // adicionamos ao display a disciplina escolhida
    let disciplina = DISCIPLINA_STORE[disciplina_id];
    let recursos_title = createApontHeader(disciplina["nome"]);
    displayer.appendChild(recursos_title);

    getApontamentos(disciplina_id, (apontamentos) => {
        if (apontamentos.length === 0) {
            return;
        }
        apontamentos.forEach((apontamento) => {
            let element = table_row_prototype.cloneNode(true);
            element.children[0].children[0].href = apontamento["link"];
            element.children[0].children[0].innerText = apontamento["nome"];
            element.children[1].innerText = apontamento["autor"];
            tablebody.appendChild(element);
        });

        // adicionamos os elementos dos ficheiros
        displayer.appendChild(recursosContainer);
        // O botão de retroceder
        let recursos_back = document.getElementById("recursos").children[1].cloneNode(true);
        // adicionamos o event handler
        recursos_back.addEventListener("click", click_handler);
        // e adicionamos ao displayer
        displayer.appendChild(recursos_back);
    });
}

function clearElement(target) {
    while (target.firstChild) {
        target.removeChild(target.firstChild);
    }
}
//#endregion

$(document).ready(function () {
    setupListeners();
});