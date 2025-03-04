/**
 * Translation functionality for DevSphere forum
 */

// Function to translate a publication
function translatePublication(publicationId, targetLang) {
    console.log(`Translating publication ${publicationId} to ${targetLang}`);
    
    // Show loading state
    const translationContainer = document.querySelector(`#translation-container-${publicationId}`);
    if (translationContainer) {
        translationContainer.innerHTML = '<div class="translation-loading">Loading translation...</div>';
        translationContainer.style.display = 'block';
    }

    // Check cache first
    const cacheKey = `translation_pub_${publicationId}_${targetLang}`;
    const cachedTranslation = getTranslationFromCache(cacheKey);
    
    if (cachedTranslation) {
        console.log('Using cached translation for publication', publicationId);
        displayTranslation(publicationId, cachedTranslation, targetLang, 'publication', 'cache');
        return;
    }

    // Make API request
    fetch(`/forum/publication/${publicationId}/translate/${targetLang}`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            console.log('Translation successful:', data);
            
            // Format the translation data
            let translationData;
            if (data.translation) {
                translationData = data.translation;
            } else {
                // Try to extract from other formats
                translationData = {
                    title: data.translatedTitle || '',
                    content: data.translatedContent || ''
                };
            }
            
            // Cache the successful translation
            saveTranslationToCache(cacheKey, translationData, 24); // Cache for 24 hours
            
            // Display the translation
            displayTranslation(publicationId, translationData, targetLang, 'publication', 'api');
        } else {
            throw new Error(data.error || 'Unknown error occurred');
        }
    })
    .catch(error => {
        console.error('Translation error:', error);
        
        // Try to get a fallback translation
        const fallbackTranslation = getFallbackTranslation(publicationId, targetLang, 'publication');
        if (fallbackTranslation) {
            console.log('Using fallback translation for publication', publicationId);
            displayTranslation(publicationId, fallbackTranslation, targetLang, 'publication', 'fallback');
        } else {
            // Show error message
            showTranslationError(publicationId, error.message, 'publication');
        }
    });
}

// Function to translate a comment
function translateComment(commentId, targetLang) {
    console.log(`Translating comment ${commentId} to ${targetLang}`);
    
    // Show loading state
    const translationContainer = document.querySelector(`#translation-container-comment-${commentId}`);
    if (translationContainer) {
        translationContainer.innerHTML = '<div class="translation-loading">Loading translation...</div>';
        translationContainer.style.display = 'block';
    }

    // Check cache first
    const cacheKey = `translation_comment_${commentId}_${targetLang}`;
    const cachedTranslation = getTranslationFromCache(cacheKey);
    
    if (cachedTranslation) {
        console.log('Using cached translation for comment', commentId);
        displayTranslation(commentId, cachedTranslation, targetLang, 'comment', 'cache');
        return;
    }

    // Make API request
    fetch(`/forum/comment/${commentId}/translate/${targetLang}`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            console.log('Translation successful:', data);
            
            // Format the translation data
            let translationData;
            if (data.translation) {
                translationData = data.translation;
            } else {
                // Try to extract from other formats
                translationData = {
                    content: data.translatedContent || ''
                };
            }
            
            // Cache the successful translation
            saveTranslationToCache(cacheKey, translationData, 24); // Cache for 24 hours
            
            // Display the translation
            displayTranslation(commentId, translationData, targetLang, 'comment', 'api');
        } else {
            throw new Error(data.error || 'Unknown error occurred');
        }
    })
    .catch(error => {
        console.error('Translation error:', error);
        
        // Try to get a fallback translation
        const fallbackTranslation = getFallbackTranslation(commentId, targetLang, 'comment');
        if (fallbackTranslation) {
            console.log('Using fallback translation for comment', commentId);
            displayTranslation(commentId, fallbackTranslation, targetLang, 'comment', 'fallback');
        } else {
            showTranslationError(commentId, error.message, 'comment');
        }
    });
}

// Display translation for a publication or comment
function displayTranslation(id, data, targetLang, type, source) {
    // Determine the correct container ID based on type
    let containerId;
    if (type === 'publication') {
        containerId = `translation-container-${id}`;
    } else if (type === 'comment') {
        containerId = `translation-container-comment-${id}`;
    } else {
        console.error('Invalid translation type:', type);
        return;
    }
    
    // Get the container element
    const container = document.querySelector(`#${containerId}`);
    if (!container) {
        console.error(`Translation container not found: #${containerId}`);
        return;
    }
    
    // Extract title and content from data
    let title = '';
    let content = '';
    
    if (data) {
        if (typeof data === 'object') {
            if (data.title !== undefined) {
                title = data.title;
            }
            if (data.content !== undefined) {
                content = data.content;
            }
        } else if (typeof data === 'string') {
            // Handle case where data might be just a string
            content = data;
        }
    }
    
    // Create translation HTML
    const translationHtml = `
        <div class="translation-meta">
            <span class="translation-language">${getLanguageName(targetLang)}</span>
            <span class="translation-source">${getSourceName(source)}</span>
        </div>
        ${title ? `<h2 class="translated-title">${title}</h2>` : ''}
        <div class="translated-content">${content}</div>
    `;
    
    // Update container with translation HTML
    container.innerHTML = translationHtml;
    container.style.display = 'block';
    
    console.log(`Translation displayed in container: #${containerId}`);
}

// Helper function to get language name from code
function getLanguageName(langCode) {
    const languages = {
        'en': 'English',
        'fr': 'French',
        'es': 'Spanish',
        'de': 'German',
        'it': 'Italian',
        'pt': 'Portuguese',
        'ru': 'Russian',
        'zh': 'Chinese',
        'ja': 'Japanese',
        'ar': 'Arabic'
    };
    
    return languages[langCode] || langCode;
}

// Helper function to get source name
function getSourceName(source) {
    const sources = {
        'api': 'API',
        'cache': 'Cache',
        'fallback': 'Fallback',
        'dictionary': 'Dictionary'
    };
    
    return sources[source] || source;
}

// Helper function to save translation to cache
function saveTranslationToCache(key, data, hours = 24) {
    try {
        const expiryTime = new Date().getTime() + (hours * 60 * 60 * 1000);
        const cacheItem = {
            data: data,
            expires: expiryTime,
            timestamp: new Date().getTime()
        };
        
        localStorage.setItem(key, JSON.stringify(cacheItem));
        console.log(`Translation saved to cache with key: ${key}`);
        return true;
    } catch (error) {
        console.error('Error saving translation to cache:', error);
        return false;
    }
}

// Helper function to get translation from cache
function getTranslationFromCache(key) {
    try {
        const cachedItem = localStorage.getItem(key);
        if (!cachedItem) {
            return null;
        }
        
        const parsedItem = JSON.parse(cachedItem);
        
        // Check if the cached item has expired
        if (parsedItem.expires && parsedItem.expires < new Date().getTime()) {
            console.log(`Cached translation expired for key: ${key}`);
            localStorage.removeItem(key);
            return null;
        }
        
        console.log(`Translation retrieved from cache with key: ${key}`);
        return parsedItem.data;
    } catch (error) {
        console.error('Error retrieving translation from cache:', error);
        return null;
    }
}

// Helper function to get fallback translation
function getFallbackTranslation(id, targetLang, type) {
    // Try to get from localStorage first (older translations)
    try {
        const cacheKey = `translation_${type === 'publication' ? 'pub' : 'comment'}_${id}_${targetLang}`;
        const cachedTranslation = getTranslationFromCache(cacheKey);
        
        if (cachedTranslation) {
            console.log(`Using cached translation for ${type} ${id} to ${targetLang}`);
            return cachedTranslation;
        }
    } catch (error) {
        console.error('Error getting fallback from cache:', error);
    }
    
    // Try simple dictionary-based translation for common phrases
    try {
        // Get the original text
        let originalText = '';
        if (type === 'publication') {
            const titleElement = document.querySelector(`#publication-${id} .publication-title`);
            const contentElement = document.querySelector(`#publication-${id} .publication-content`);
            
            if (titleElement && contentElement) {
                originalText = titleElement.textContent + ' ' + contentElement.textContent;
            }
        } else if (type === 'comment') {
            const contentElement = document.querySelector(`#comment-${id} .comment-content`);
            
            if (contentElement) {
                originalText = contentElement.textContent;
            }
        }
        
        if (originalText) {
            const simpleTrans = attemptSimpleTranslation(originalText, targetLang);
            if (simpleTrans) {
                return {
                    title: type === 'publication' ? attemptSimpleTranslation(document.querySelector(`#publication-${id} .publication-title`)?.textContent || '', targetLang) : '',
                    content: simpleTrans
                };
            }
        }
    } catch (error) {
        console.error('Error getting fallback from dictionary:', error);
    }
    
    return null;
}

// Helper function to attempt simple translation
function attemptSimpleTranslation(text, targetLang) {
    // Dictionary of common phrases in different languages
    const commonPhrases = {
        'fr': {
            'hello': 'bonjour',
            'hi': 'salut',
            'thank you': 'merci',
            'thanks': 'merci',
            'yes': 'sí',
            'no': 'no',
            'good': 'bueno',
            'bad': 'malo',
            'welcome': 'bienvenido',
            'please': 'por favor',
            'sorry': 'lo siento',
            'help': 'ayuda',
            'problem': 'problema',
            'solution': 'solución',
            'code': 'código',
            'programming': 'programación',
            'developer': 'desarrollador',
            'software': 'software',
            'web': 'web',
            'application': 'aplicación',
            'database': 'base de datos',
            'server': 'servidor',
            'client': 'cliente',
            'user': 'usuario',
            'interface': 'interfaz',
            'design': 'diseño',
            'bug': 'error',
            'error': 'error',
            'feature': 'característica',
            'update': 'actualización',
            'version': 'versión',
            'comment': 'comentario',
            'post': 'publicación',
            'forum': 'foro',
            'community': 'comunidad',
            'project': 'proyecto',
            'team': 'equipo',
            'work': 'trabajo',
            'job': 'trabajo',
            'task': 'tarea',
            'deadline': 'fecha límite',
            'meeting': 'reunión',
            'discussion': 'discusión',
            'idea': 'idea',
            'suggestion': 'sugerencia',
            'feedback': 'retroalimentación',
            'review': 'revisión',
            'test': 'prueba',
            'debug': 'depurar',
            'fix': 'arreglar',
            'improve': 'mejorar',
            'optimize': 'optimizar',
            'performance': 'rendimiento',
            'security': 'seguridad',
            'documentation': 'documentación',
            'guide': 'guía',
            'tutorial': 'tutorial',
            'example': 'ejemplo',
            'reference': 'referencia',
            'resource': 'recurso',
            'tool': 'herramienta',
            'library': 'biblioteca',
            'framework': 'marco',
            'language': 'lenguaje',
            'syntax': 'sintaxis',
            'function': 'función',
            'method': 'método',
            'class': 'clase',
            'object': 'objeto',
            'variable': 'variable',
            'constant': 'constante',
            'parameter': 'parámetro',
            'argument': 'argumento',
            'return': 'retorno',
            'value': 'valor',
            'type': 'tipo',
            'data': 'datos',
            'input': 'entrada',
            'output': 'salida',
            'file': 'archivo',
            'directory': 'directorio',
            'path': 'ruta',
            'system': 'sistema',
            'network': 'red',
            'connection': 'conexión',
            'request': 'solicitud',
            'response': 'respuesta',
            'api': 'api',
            'endpoint': 'punto final',
            'service': 'servicio',
            'component': 'componente',
            'module': 'módulo',
            'package': 'paquete',
            'dependency': 'dependencia',
            'installation': 'instalación',
            'configuration': 'configuración',
            'setting': 'ajuste',
            'option': 'opción',
            'preference': 'preferencia',
            'profile': 'perfil',
            'account': 'cuenta',
            'login': 'iniciar sesión',
            'logout': 'cerrar sesión',
            'register': 'registrarse',
            'sign up': 'registrarse',
            'sign in': 'iniciar sesión',
            'password': 'contraseña',
            'username': 'nombre de usuario',
            'email': 'correo electrónico',
            'message': 'mensaje',
            'notification': 'notificación',
            'alert': 'alerta',
            'warning': 'advertencia',
            'info': 'información',
            'success': 'éxito',
            'failure': 'fallo',
            'loading': 'cargando',
            'processing': 'procesando',
            'saving': 'guardando',
            'deleting': 'eliminando',
            'editing': 'editando',
            'creating': 'creando',
            'updating': 'actualizando',
            'searching': 'buscando',
            'filtering': 'filtrando',
            'sorting': 'ordenando',
            'pagination': 'paginación',
            'navigation': 'navegación',
            'menu': 'menú',
            'dashboard': 'panel',
            'home': 'inicio',
            'about': 'acerca de',
            'contact': 'contacto',
            'support': 'soporte',
            'help center': 'centro de ayuda',
            'faq': 'preguntas frecuentes',
            'terms': 'términos',
            'privacy': 'privacidad',
            'policy': 'política',
            'agreement': 'acuerdo',
            'license': 'licencia',
            'copyright': 'derechos de autor',
            'trademark': 'marca registrada',
            'legal': 'legal'
        },
        // Add more languages as needed
    };
    
    // Get dictionary for target language
    const dictionary = commonPhrases[targetLang];
    if (!dictionary) {
        return `[${targetLang.toUpperCase()}] ${text}`;
    }
    
    // Simple word-by-word translation
    let translatedText = text;
    
    // Replace common phrases (case insensitive)
    Object.keys(dictionary).forEach(phrase => {
        const regex = new RegExp('\\b' + phrase + '\\b', 'gi');
        translatedText = translatedText.replace(regex, match => {
            // Preserve case if possible
            if (match === match.toLowerCase()) {
                return dictionary[phrase];
            } else if (match === match.toUpperCase()) {
                return dictionary[phrase].toUpperCase();
            } else if (match.charAt(0) === match.charAt(0).toUpperCase()) {
                return dictionary[phrase].charAt(0).toUpperCase() + dictionary[phrase].slice(1);
            }
            return dictionary[phrase];
        });
    });
    
    // If no translation was made, add language tag
    if (translatedText === text) {
        translatedText = `[${targetLang.toUpperCase()}] ${text}`;
    }
    
    return translatedText;
}

// Show translation error
function showTranslationError(id, errorMessage, type) {
    // Determine the correct container ID based on type
    let containerId;
    if (type === 'publication') {
        containerId = `translation-container-${id}`;
    } else if (type === 'comment') {
        containerId = `translation-container-comment-${id}`;
    } else {
        console.error('Invalid translation type:', type);
        return;
    }
    
    // Get the container element
    const container = document.querySelector(`#${containerId}`);
    if (!container) {
        console.error(`Translation container not found: #${containerId}`);
        return;
    }
    
    // Display error message
    container.innerHTML = `
        <div class="alert alert-danger">
            <strong>Translation Error:</strong> ${errorMessage}
        </div>
    `;
    container.style.display = 'block';
    
    console.error(`Translation error displayed in container: #${containerId}`, errorMessage);
}

// Initialize translation functionality when the DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Attach event listeners to translation dropdown items
    document.querySelectorAll('.translate-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const publicationId = this.getAttribute('data-publication-id');
            const targetLang = this.getAttribute('data-lang');
            
            if (publicationId && targetLang) {
                translatePublication(publicationId, targetLang);
            }
        });
    });
    
    // Attach event listeners to comment translation dropdown items
    document.querySelectorAll('.translate-comment-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const commentId = this.getAttribute('data-comment-id');
            const targetLang = this.getAttribute('data-lang');
            
            if (commentId && targetLang) {
                translateComment(commentId, targetLang);
            }
        });
    });
});
