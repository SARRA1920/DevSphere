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

/* exercice/show.html.twig */
class __TwigTemplate_0450ab0a83c802de20d4af1776a9e853 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "exercice/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "exercice/show.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "exercice/show.html.twig", 1);
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
        .exercise-info {
            background-color: #f8f9fa;
            border-left: 4px solid #17a2b8;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        .exercise-description {
            white-space: pre-wrap;
            font-size: 1.1rem;
            line-height: 1.6;
            color: #2c3e50;
        }
        .exercise-metadata {
            display: flex;
            gap: 1rem;
            color: #6c757d;
            font-size: 0.9rem;
            margin-top: 1rem;
        }
        .exercise-metadata i {
            color: #17a2b8;
        }
    </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 37
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

        // line 38
        yield "<div class=\"container py-5\">
    <div class=\"row\">
        <div class=\"col-md-8 mx-auto\">
            <div class=\"card shadow\">
                <div class=\"card-header bg-primary text-white d-flex justify-content-between align-items-center\">
                    <h2 class=\"h4 mb-0\">";
        // line 43
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 43, $this->source); })()), "titre", [], "any", false, false, false, 43), "html", null, true);
        yield "</h2>
                    <span class=\"badge bg-light text-primary\">";
        // line 44
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 44, $this->source); })()), "typeExercice", [], "any", false, false, false, 44)), "html", null, true);
        yield "</span>
                </div>
                <div class=\"card-body\">
                    <!-- Description de l'exercice -->
                    <div class=\"exercise-info\">
                        <h5 class=\"text-primary mb-3\">Description de l'exercice</h5>
                        <div class=\"exercise-description\">";
        // line 50
        yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 50, $this->source); })()), "description", [], "any", false, false, false, 50), "html", null, true));
        yield "</div>
                        <div class=\"exercise-metadata\">
                            <span><i class=\"fas fa-clock\"></i> ";
        // line 52
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 52, $this->source); })()), "tempsEstime", [], "any", false, false, false, 52), "html", null, true);
        yield " minutes</span>
                            <span><i class=\"fas fa-star\"></i> Note minimale : ";
        // line 53
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 53, $this->source); })()), "noteMinimale", [], "any", false, false, false, 53), "html", null, true);
        yield "/20</span>
                            <span><i class=\"fas fa-layer-group\"></i> Niveau : ";
        // line 54
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 54, $this->source); })()), "niveauDifficulte", [], "any", false, false, false, 54)), "html", null, true);
        yield "</span>
                        </div>
                    </div>

                    ";
        // line 58
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 58, $this->source); })()), "fichierPdf", [], "any", false, false, false, 58)) {
            // line 59
            yield "                        <div class=\"mb-4\">
                            <h5 class=\"text-primary\">Document de référence</h5>
                            <a href=\"";
            // line 61
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/exercices/" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 61, $this->source); })()), "fichierPdf", [], "any", false, false, false, 61))), "html", null, true);
            yield "\" 
                               class=\"btn btn-outline-primary\" target=\"_blank\">
                                <i class=\"fas fa-file-pdf me-2\"></i>
                                Voir le PDF
                            </a>
                        </div>
                    ";
        }
        // line 68
        yield "
                    <form action=\"";
        // line 69
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tentative_submit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 69, $this->source); })()), "id", [], "any", false, false, false, 69)]), "html", null, true);
        yield "\" method=\"post\" class=\"mt-4\">
                        ";
        // line 70
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 70, $this->source); })()), "typeExercice", [], "any", false, false, false, 70) == "qcm")) {
            // line 71
            yield "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["questions"]) || array_key_exists("questions", $context) ? $context["questions"] : (function () { throw new RuntimeError('Variable "questions" does not exist.', 71, $this->source); })()));
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
                // line 72
                yield "                                <div class=\"mb-4\">
                                    <h5>";
                // line 73
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["question"], "html", null, true);
                yield "</h5>
                                    <input type=\"hidden\" name=\"questions[]\" value=\"";
                // line 74
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["question"], "html", null, true);
                yield "\">
                                    ";
                // line 75
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
                    // line 76
                    yield "                                        <div class=\"form-check\">
                                            <input class=\"form-check-input\" type=\"radio\" 
                                                   name=\"reponse_";
                    // line 78
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "parent", [], "any", false, false, false, 78), "loop", [], "any", false, false, false, 78), "index0", [], "any", false, false, false, 78), "html", null, true);
                    yield "\" 
                                                   value=\"";
                    // line 79
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["option"], "html", null, true);
                    yield "\" 
                                                   id=\"option";
                    // line 80
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "parent", [], "any", false, false, false, 80), "loop", [], "any", false, false, false, 80), "index0", [], "any", false, false, false, 80), "html", null, true);
                    yield "_";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 80), "html", null, true);
                    yield "\"
                                                   required>
                                            <label class=\"form-check-label\" 
                                                   for=\"option";
                    // line 83
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "parent", [], "any", false, false, false, 83), "loop", [], "any", false, false, false, 83), "index0", [], "any", false, false, false, 83), "html", null, true);
                    yield "_";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 83), "html", null, true);
                    yield "\">
                                                ";
                    // line 84
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
                // line 88
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
            // line 90
            yield "
                        ";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source,         // line 91
(isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 91, $this->source); })()), "typeExercice", [], "any", false, false, false, 91) == "true_false")) {
            // line 92
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
        } elseif (CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source,         // line 103
(isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 103, $this->source); })()), "typeExercice", [], "any", false, false, false, 103), ["html", "javascript", "php"])) {
            // line 104
            yield "                            <div class=\"mb-4\">
                                <div class=\"code-editor-wrapper\">
                                    <div class=\"d-flex justify-content-between align-items-center mb-2\">
                                        <label for=\"code-editor\" class=\"form-label\">Votre code :</label>
                                        <div class=\"btn-group\">
                                            <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\" id=\"format-code\">
                                                <i class=\"fas fa-code me-1\"></i>Formater
                                            </button>
                                        </div>
                                    </div>
                                    <textarea id=\"code-editor\" name=\"reponse\" class=\"form-control code-editor\" 
                                              rows=\"10\" required></textarea>
                                </div>
                            </div>

                        ";
        } else {
            // line 120
            yield "                            <div class=\"mb-4\">
                                <label for=\"reponse\" class=\"form-label\">Votre réponse :</label>
                                <textarea name=\"reponse\" id=\"reponse\" class=\"form-control\" 
                                          rows=\"5\" required></textarea>
                            </div>
                        ";
        }
        // line 126
        yield "
                        <div class=\"d-grid gap-2\">
                            <button type=\"submit\" class=\"btn btn-primary\">
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

    // line 140
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

        // line 141
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
";
        // line 142
        if (CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 142, $this->source); })()), "typeExercice", [], "any", false, false, false, 142), ["html", "javascript", "php"])) {
            // line 143
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
            // line 154
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 154, $this->source); })()), "typeExercice", [], "any", false, false, false, 154), "html", null, true);
            yield "',
                theme: 'monokai',
                indentUnit: 4,
                autoCloseBrackets: true,
                matchBrackets: true,
                lineWrapping: true
            });

            document.getElementById('format-code').addEventListener('click', function() {
                var totalLines = editor.lineCount();
                var totalChars = editor.getValue().length;
                
                // Format code based on language
                switch ('";
            // line 167
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 167, $this->source); })()), "typeExercice", [], "any", false, false, false, 167), "html", null, true);
            yield "') {
                    case 'html':
                        // Basic HTML formatting
                        var formatted = html_beautify(editor.getValue());
                        editor.setValue(formatted);
                        break;
                    case 'javascript':
                        // Basic JS formatting
                        var formatted = js_beautify(editor.getValue());
                        editor.setValue(formatted);
                        break;
                    case 'php':
                        // For PHP, we might need a different approach
                        // This is a basic indentation
                        editor.execCommand('selectAll');
                        editor.execCommand('indentAuto');
                        break;
                }
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
        return "exercice/show.html.twig";
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
        return array (  449 => 167,  433 => 154,  420 => 143,  418 => 142,  414 => 141,  401 => 140,  378 => 126,  370 => 120,  352 => 104,  350 => 103,  337 => 92,  335 => 91,  332 => 90,  317 => 88,  299 => 84,  293 => 83,  285 => 80,  281 => 79,  277 => 78,  273 => 76,  256 => 75,  252 => 74,  248 => 73,  245 => 72,  227 => 71,  225 => 70,  221 => 69,  218 => 68,  208 => 61,  204 => 59,  202 => 58,  195 => 54,  191 => 53,  187 => 52,  182 => 50,  173 => 44,  169 => 43,  162 => 38,  149 => 37,  114 => 11,  109 => 8,  107 => 7,  102 => 6,  89 => 5,  66 => 3,  43 => 1,);
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
        .exercise-info {
            background-color: #f8f9fa;
            border-left: 4px solid #17a2b8;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        .exercise-description {
            white-space: pre-wrap;
            font-size: 1.1rem;
            line-height: 1.6;
            color: #2c3e50;
        }
        .exercise-metadata {
            display: flex;
            gap: 1rem;
            color: #6c757d;
            font-size: 0.9rem;
            margin-top: 1rem;
        }
        .exercise-metadata i {
            color: #17a2b8;
        }
    </style>
{% endblock %}

{% block content %}
<div class=\"container py-5\">
    <div class=\"row\">
        <div class=\"col-md-8 mx-auto\">
            <div class=\"card shadow\">
                <div class=\"card-header bg-primary text-white d-flex justify-content-between align-items-center\">
                    <h2 class=\"h4 mb-0\">{{ exercice.titre }}</h2>
                    <span class=\"badge bg-light text-primary\">{{ exercice.typeExercice|upper }}</span>
                </div>
                <div class=\"card-body\">
                    <!-- Description de l'exercice -->
                    <div class=\"exercise-info\">
                        <h5 class=\"text-primary mb-3\">Description de l'exercice</h5>
                        <div class=\"exercise-description\">{{ exercice.description|nl2br }}</div>
                        <div class=\"exercise-metadata\">
                            <span><i class=\"fas fa-clock\"></i> {{ exercice.tempsEstime }} minutes</span>
                            <span><i class=\"fas fa-star\"></i> Note minimale : {{ exercice.noteMinimale }}/20</span>
                            <span><i class=\"fas fa-layer-group\"></i> Niveau : {{ exercice.niveauDifficulte|capitalize }}</span>
                        </div>
                    </div>

                    {% if exercice.fichierPdf %}
                        <div class=\"mb-4\">
                            <h5 class=\"text-primary\">Document de référence</h5>
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
                            <div class=\"mb-4\">
                                <div class=\"code-editor-wrapper\">
                                    <div class=\"d-flex justify-content-between align-items-center mb-2\">
                                        <label for=\"code-editor\" class=\"form-label\">Votre code :</label>
                                        <div class=\"btn-group\">
                                            <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\" id=\"format-code\">
                                                <i class=\"fas fa-code me-1\"></i>Formater
                                            </button>
                                        </div>
                                    </div>
                                    <textarea id=\"code-editor\" name=\"reponse\" class=\"form-control code-editor\" 
                                              rows=\"10\" required></textarea>
                                </div>
                            </div>

                        {% else %}
                            <div class=\"mb-4\">
                                <label for=\"reponse\" class=\"form-label\">Votre réponse :</label>
                                <textarea name=\"reponse\" id=\"reponse\" class=\"form-control\" 
                                          rows=\"5\" required></textarea>
                            </div>
                        {% endif %}

                        <div class=\"d-grid gap-2\">
                            <button type=\"submit\" class=\"btn btn-primary\">
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
                var totalLines = editor.lineCount();
                var totalChars = editor.getValue().length;
                
                // Format code based on language
                switch ('{{ exercice.typeExercice }}') {
                    case 'html':
                        // Basic HTML formatting
                        var formatted = html_beautify(editor.getValue());
                        editor.setValue(formatted);
                        break;
                    case 'javascript':
                        // Basic JS formatting
                        var formatted = js_beautify(editor.getValue());
                        editor.setValue(formatted);
                        break;
                    case 'php':
                        // For PHP, we might need a different approach
                        // This is a basic indentation
                        editor.execCommand('selectAll');
                        editor.execCommand('indentAuto');
                        break;
                }
            });
        });
    </script>
{% endif %}
{% endblock %}
", "exercice/show.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\exercice\\show.html.twig");
    }
}
