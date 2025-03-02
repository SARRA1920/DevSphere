<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* exercice/user_show.html.twig */
class __TwigTemplate_684cc4178e8e1cf0b4f100eb33e28d3b extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'content' => [$this, 'block_content'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "exercice/user_show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "exercice/user_show.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "exercice/user_show.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 3, $this->source); })()), "titre", [], "any", false, false, false, 3), "html", null, true);
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 6
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
    ";
        // line 7
        if (CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 7, $this->source); })()), "typeExercice", [], "any", false, false, false, 7), ["html", "javascript", "php"])) {
            // line 8
            yield "        <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css\">
        <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/monokai.min.css\">
    ";
        }
        // line 11
        yield "    <style>
        .exercise-card {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .exercise-header {
            background: linear-gradient(45deg, #2196F3, #1976D2);
            color: white;
            padding: 1.5rem;
            border-radius: 0.5rem 0.5rem 0 0;
        }
        .exercise-info {
            background-color: #f8f9fa;
            border-left: 4px solid #2196F3;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-radius: 0.25rem;
        }
        .exercise-description {
            white-space: pre-wrap;
            font-size: 1.1rem;
            line-height: 1.6;
            color: #2c3e50;
        }
        .exercise-metadata {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(0,0,0,0.1);
        }
        .metadata-item {
            display: flex;
            align-items: center;
            color: #6c757d;
        }
        .metadata-item i {
            color: #2196F3;
            margin-right: 0.5rem;
            font-size: 1.1rem;
        }
        .code-editor-wrapper {
            background: #2d2d2d;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-top: 1.5rem;
        }
        .code-editor-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            color: white;
        }
        .CodeMirror {
            height: auto;
            min-height: 300px;
            border-radius: 0.25rem;
            font-size: 14px;
        }
    </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 75
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 76
        yield "<div class=\"container py-5\">
    <div class=\"row justify-content-center\">
        <div class=\"col-lg-10\">
            <div class=\"card exercise-card\">
                <div class=\"exercise-header\">
                    <h1 class=\"h3 mb-2\">";
        // line 81
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 81, $this->source); })()), "titre", [], "any", false, false, false, 81), "html", null, true);
        yield "</h1>
                    <div class=\"d-flex align-items-center\">
                        <span class=\"badge bg-light text-primary me-2\">";
        // line 83
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 83, $this->source); })()), "typeExercice", [], "any", false, false, false, 83)), "html", null, true);
        yield "</span>
                        <span class=\"badge ";
        // line 84
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 84, $this->source); })()), "niveauDifficulte", [], "any", false, false, false, 84) == "facile")) {
            yield "bg-success";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 84, $this->source); })()), "niveauDifficulte", [], "any", false, false, false, 84) == "moyen")) {
            yield "bg-warning";
        } else {
            yield "bg-danger";
        }
        yield "\">
                            ";
        // line 85
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 85, $this->source); })()), "niveauDifficulte", [], "any", false, false, false, 85)), "html", null, true);
        yield "
                        </span>
                    </div>
                </div>
                
                <div class=\"card-body p-4\">
                    <!-- Description de l'exercice -->
                    <div class=\"exercise-info\">
                        <h5 class=\"text-primary mb-3\">Description de l'exercice</h5>
                        <div class=\"exercise-description\">";
        // line 94
        yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 94, $this->source); })()), "description", [], "any", false, false, false, 94), "html", null, true));
        yield "</div>
                        <div class=\"exercise-metadata\">
                            <div class=\"metadata-item\">
                                <i class=\"fas fa-clock\"></i>
                                <span>";
        // line 98
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 98, $this->source); })()), "tempsEstime", [], "any", false, false, false, 98), "html", null, true);
        yield " minutes</span>
                            </div>
                            <div class=\"metadata-item\">
                                <i class=\"fas fa-star\"></i>
                                <span>Note minimale : ";
        // line 102
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 102, $this->source); })()), "noteMinimale", [], "any", false, false, false, 102), "html", null, true);
        yield "/20</span>
                            </div>
                            <div class=\"metadata-item\">
                                <i class=\"fas fa-layer-group\"></i>
                                <span>Niveau : ";
        // line 106
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 106, $this->source); })()), "niveauDifficulte", [], "any", false, false, false, 106)), "html", null, true);
        yield "</span>
                            </div>
                        </div>
                    </div>

                    ";
        // line 111
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 111, $this->source); })()), "fichierPdf", [], "any", false, false, false, 111)) {
            // line 112
            yield "                        <div class=\"mb-4\">
                            <h5 class=\"text-primary mb-3\">Document de référence</h5>
                            <a href=\"";
            // line 114
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/exercices/" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 114, $this->source); })()), "fichierPdf", [], "any", false, false, false, 114))), "html", null, true);
            yield "\" 
                               class=\"btn btn-outline-primary\" target=\"_blank\">
                                <i class=\"fas fa-file-pdf me-2\"></i>
                                Voir le PDF
                            </a>
                        </div>
                    ";
        }
        // line 121
        yield "
                    <form action=\"";
        // line 122
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tentative_submit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 122, $this->source); })()), "id", [], "any", false, false, false, 122)]), "html", null, true);
        yield "\" method=\"post\" class=\"mt-4\">
                        ";
        // line 123
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 123, $this->source); })()), "typeExercice", [], "any", false, false, false, 123) == "qcm")) {
            // line 124
            yield "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["questions"]) || array_key_exists("questions", $context) ? $context["questions"] : (function () { throw new RuntimeError('Variable "questions" does not exist.', 124, $this->source); })()));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["question"] => $context["options"]) {
                // line 125
                yield "                                <div class=\"mb-4\">
                                    <h5>";
                // line 126
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["question"], "html", null, true);
                yield "</h5>
                                    <input type=\"hidden\" name=\"questions[]\" value=\"";
                // line 127
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["question"], "html", null, true);
                yield "\">
                                    ";
                // line 128
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable($context["options"]);
                $context['loop'] = [
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                ];
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                    // line 129
                    yield "                                        <div class=\"form-check\">
                                            <input class=\"form-check-input\" type=\"radio\" 
                                                   name=\"reponse_";
                    // line 131
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "parent", [], "any", false, false, false, 131), "loop", [], "any", false, false, false, 131), "index0", [], "any", false, false, false, 131), "html", null, true);
                    yield "\" 
                                                   value=\"";
                    // line 132
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["option"], "html", null, true);
                    yield "\" 
                                                   id=\"option";
                    // line 133
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "parent", [], "any", false, false, false, 133), "loop", [], "any", false, false, false, 133), "index0", [], "any", false, false, false, 133), "html", null, true);
                    yield "_";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 133), "html", null, true);
                    yield "\"
                                                   required>
                                            <label class=\"form-check-label\" 
                                                   for=\"option";
                    // line 136
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "parent", [], "any", false, false, false, 136), "loop", [], "any", false, false, false, 136), "index0", [], "any", false, false, false, 136), "html", null, true);
                    yield "_";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 136), "html", null, true);
                    yield "\">
                                                ";
                    // line 137
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["option"], "html", null, true);
                    yield "
                                            </label>
                                        </div>
                                    ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 141
                yield "                                </div>
                            ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['question'], $context['options'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 143
            yield "
                        ";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source,         // line 144
(isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 144, $this->source); })()), "typeExercice", [], "any", false, false, false, 144) == "true_false")) {
            // line 145
            yield "                            <div class=\"mb-4\">
                                <div class=\"form-check\">
                                    <input class=\"form-check-input\" type=\"radio\" name=\"reponse\" value=\"true\" id=\"true\" required>
                                    <label class=\"form-check-label\" for=\"true\">Vrai</label>
                                </div>
                                <div class=\"form-check\">
                                    <input class=\"form-check-input\" type=\"radio\" name=\"reponse\" value=\"false\" id=\"false\" required>
                                    <label class=\"form-check-label\" for=\"false\">Faux</label>
                                </div>
                            </div>

                        ";
        } elseif (CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source,         // line 156
(isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 156, $this->source); })()), "typeExercice", [], "any", false, false, false, 156), ["html", "javascript", "php"])) {
            // line 157
            yield "                            <div class=\"code-editor-wrapper\">
                                <div class=\"code-editor-header\">
                                    <label for=\"code-editor\" class=\"mb-0\">Votre code</label>
                                    <button type=\"button\" class=\"btn btn-outline-light btn-sm\" id=\"format-code\">
                                        <i class=\"fas fa-code me-1\"></i>Formater
                                    </button>
                                </div>
                                <textarea id=\"code-editor\" name=\"reponse\" class=\"form-control code-editor\" 
                                          rows=\"10\" required></textarea>
                            </div>

                        ";
        } else {
            // line 169
            yield "                            <div class=\"mb-4\">
                                <label for=\"reponse\" class=\"form-label\">Votre réponse</label>
                                <textarea name=\"reponse\" id=\"reponse\" class=\"form-control\" 
                                          rows=\"5\" required></textarea>
                            </div>
                        ";
        }
        // line 175
        yield "
                        <div class=\"d-grid gap-2 mt-4\">
                            <button type=\"submit\" class=\"btn btn-primary btn-lg\">
                                <i class=\"fas fa-paper-plane me-2\"></i>Soumettre votre réponse
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 189
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 190
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
";
        // line 191
        if (CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 191, $this->source); })()), "typeExercice", [], "any", false, false, false, 191), ["html", "javascript", "php"])) {
            // line 192
            yield "    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/xml/xml.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/javascript/javascript.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/css/css.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/htmlmixed/htmlmixed.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/php/php.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/clike/clike.min.js\"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editor = CodeMirror.fromTextArea(document.getElementById('code-editor'), {
                lineNumbers: true,
                mode: '";
            // line 203
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 203, $this->source); })()), "typeExercice", [], "any", false, false, false, 203), "html", null, true);
            yield "',
                theme: 'monokai',
                indentUnit: 4,
                autoCloseBrackets: true,
                matchBrackets: true,
                lineWrapping: true
            });

            document.getElementById('format-code').addEventListener('click', function() {
                editor.execCommand('selectAll');
                editor.execCommand('indentAuto');
            });
        });
    </script>
";
        }
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "exercice/user_show.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  494 => 203,  481 => 192,  479 => 191,  475 => 190,  462 => 189,  439 => 175,  431 => 169,  417 => 157,  415 => 156,  402 => 145,  400 => 144,  397 => 143,  382 => 141,  364 => 137,  358 => 136,  350 => 133,  346 => 132,  342 => 131,  338 => 129,  321 => 128,  317 => 127,  313 => 126,  310 => 125,  292 => 124,  290 => 123,  286 => 122,  283 => 121,  273 => 114,  269 => 112,  267 => 111,  259 => 106,  252 => 102,  245 => 98,  238 => 94,  226 => 85,  216 => 84,  212 => 83,  207 => 81,  200 => 76,  187 => 75,  114 => 11,  109 => 8,  107 => 7,  102 => 6,  89 => 5,  66 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}{{ exercice.titre }}{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    {% if exercice.typeExercice in ['html', 'javascript', 'php'] %}
        <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css\">
        <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/monokai.min.css\">
    {% endif %}
    <style>
        .exercise-card {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .exercise-header {
            background: linear-gradient(45deg, #2196F3, #1976D2);
            color: white;
            padding: 1.5rem;
            border-radius: 0.5rem 0.5rem 0 0;
        }
        .exercise-info {
            background-color: #f8f9fa;
            border-left: 4px solid #2196F3;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-radius: 0.25rem;
        }
        .exercise-description {
            white-space: pre-wrap;
            font-size: 1.1rem;
            line-height: 1.6;
            color: #2c3e50;
        }
        .exercise-metadata {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(0,0,0,0.1);
        }
        .metadata-item {
            display: flex;
            align-items: center;
            color: #6c757d;
        }
        .metadata-item i {
            color: #2196F3;
            margin-right: 0.5rem;
            font-size: 1.1rem;
        }
        .code-editor-wrapper {
            background: #2d2d2d;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-top: 1.5rem;
        }
        .code-editor-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            color: white;
        }
        .CodeMirror {
            height: auto;
            min-height: 300px;
            border-radius: 0.25rem;
            font-size: 14px;
        }
    </style>
{% endblock %}

{% block content %}
<div class=\"container py-5\">
    <div class=\"row justify-content-center\">
        <div class=\"col-lg-10\">
            <div class=\"card exercise-card\">
                <div class=\"exercise-header\">
                    <h1 class=\"h3 mb-2\">{{ exercice.titre }}</h1>
                    <div class=\"d-flex align-items-center\">
                        <span class=\"badge bg-light text-primary me-2\">{{ exercice.typeExercice|upper }}</span>
                        <span class=\"badge {% if exercice.niveauDifficulte == 'facile' %}bg-success{% elseif exercice.niveauDifficulte == 'moyen' %}bg-warning{% else %}bg-danger{% endif %}\">
                            {{ exercice.niveauDifficulte|capitalize }}
                        </span>
                    </div>
                </div>
                
                <div class=\"card-body p-4\">
                    <!-- Description de l'exercice -->
                    <div class=\"exercise-info\">
                        <h5 class=\"text-primary mb-3\">Description de l'exercice</h5>
                        <div class=\"exercise-description\">{{ exercice.description|nl2br }}</div>
                        <div class=\"exercise-metadata\">
                            <div class=\"metadata-item\">
                                <i class=\"fas fa-clock\"></i>
                                <span>{{ exercice.tempsEstime }} minutes</span>
                            </div>
                            <div class=\"metadata-item\">
                                <i class=\"fas fa-star\"></i>
                                <span>Note minimale : {{ exercice.noteMinimale }}/20</span>
                            </div>
                            <div class=\"metadata-item\">
                                <i class=\"fas fa-layer-group\"></i>
                                <span>Niveau : {{ exercice.niveauDifficulte|capitalize }}</span>
                            </div>
                        </div>
                    </div>

                    {% if exercice.fichierPdf %}
                        <div class=\"mb-4\">
                            <h5 class=\"text-primary mb-3\">Document de référence</h5>
                            <a href=\"{{ asset('uploads/exercices/' ~ exercice.fichierPdf) }}\" 
                               class=\"btn btn-outline-primary\" target=\"_blank\">
                                <i class=\"fas fa-file-pdf me-2\"></i>
                                Voir le PDF
                            </a>
                        </div>
                    {% endif %}

                    <form action=\"{{ path('app_tentative_submit', {'id': exercice.id}) }}\" method=\"post\" class=\"mt-4\">
                        {% if exercice.typeExercice == 'qcm' %}
                            {% for question, options in questions %}
                                <div class=\"mb-4\">
                                    <h5>{{ question }}</h5>
                                    <input type=\"hidden\" name=\"questions[]\" value=\"{{ question }}\">
                                    {% for option in options %}
                                        <div class=\"form-check\">
                                            <input class=\"form-check-input\" type=\"radio\" 
                                                   name=\"reponse_{{ loop.parent.loop.index0 }}\" 
                                                   value=\"{{ option }}\" 
                                                   id=\"option{{ loop.parent.loop.index0 }}_{{ loop.index }}\"
                                                   required>
                                            <label class=\"form-check-label\" 
                                                   for=\"option{{ loop.parent.loop.index0 }}_{{ loop.index }}\">
                                                {{ option }}
                                            </label>
                                        </div>
                                    {% endfor %}
                                </div>
                            {% endfor %}

                        {% elseif exercice.typeExercice == 'true_false' %}
                            <div class=\"mb-4\">
                                <div class=\"form-check\">
                                    <input class=\"form-check-input\" type=\"radio\" name=\"reponse\" value=\"true\" id=\"true\" required>
                                    <label class=\"form-check-label\" for=\"true\">Vrai</label>
                                </div>
                                <div class=\"form-check\">
                                    <input class=\"form-check-input\" type=\"radio\" name=\"reponse\" value=\"false\" id=\"false\" required>
                                    <label class=\"form-check-label\" for=\"false\">Faux</label>
                                </div>
                            </div>

                        {% elseif exercice.typeExercice in ['html', 'javascript', 'php'] %}
                            <div class=\"code-editor-wrapper\">
                                <div class=\"code-editor-header\">
                                    <label for=\"code-editor\" class=\"mb-0\">Votre code</label>
                                    <button type=\"button\" class=\"btn btn-outline-light btn-sm\" id=\"format-code\">
                                        <i class=\"fas fa-code me-1\"></i>Formater
                                    </button>
                                </div>
                                <textarea id=\"code-editor\" name=\"reponse\" class=\"form-control code-editor\" 
                                          rows=\"10\" required></textarea>
                            </div>

                        {% else %}
                            <div class=\"mb-4\">
                                <label for=\"reponse\" class=\"form-label\">Votre réponse</label>
                                <textarea name=\"reponse\" id=\"reponse\" class=\"form-control\" 
                                          rows=\"5\" required></textarea>
                            </div>
                        {% endif %}

                        <div class=\"d-grid gap-2 mt-4\">
                            <button type=\"submit\" class=\"btn btn-primary btn-lg\">
                                <i class=\"fas fa-paper-plane me-2\"></i>Soumettre votre réponse
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}

{% block javascripts %}
{{ parent() }}
{% if exercice.typeExercice in ['html', 'javascript', 'php'] %}
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/xml/xml.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/javascript/javascript.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/css/css.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/htmlmixed/htmlmixed.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/php/php.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/clike/clike.min.js\"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editor = CodeMirror.fromTextArea(document.getElementById('code-editor'), {
                lineNumbers: true,
                mode: '{{ exercice.typeExercice }}',
                theme: 'monokai',
                indentUnit: 4,
                autoCloseBrackets: true,
                matchBrackets: true,
                lineWrapping: true
            });

            document.getElementById('format-code').addEventListener('click', function() {
                editor.execCommand('selectAll');
                editor.execCommand('indentAuto');
            });
        });
    </script>
{% endif %}
{% endblock %}
", "exercice/user_show.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\exercice\\user_show.html.twig");
    }
}
